<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 06/05/2018
 * Time: 22:04
 */

namespace App\Businnes;


use App\Append;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function crawler(Append $a)
    {
        if(!isset($a->file_link))
            return false;
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL => $a->file_link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HEADER => true,
            CURLOPT_POST => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        );
        curl_setopt_array($ch, $curlConfig);
        $response = curl_exec($ch);
        $curlError = curl_errno($ch);
        if ($curlError) {
            if ($curlError == 52) {
                $a->file_location = null;
                $a->name = 'Link Invalido - ' . $a->name;
                return false;
            }
            throw new \Exception('Curl erro: ' . $curlError . ' - ' . curl_error($ch) . 'in Link: ' . $a->file_link);
        }

        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        curl_close($ch);

        $header = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);
        $headerLines = explode(PHP_EOL, $header);
        $fileExtension = null;
        $i = 0;
        while (!isset($fileExtension)) {
            try{
            if (stripos($headerLines[$i], 'filename')) {
                $fileExtension = substr(str_replace('"', '', trim($headerLines[$i])), -4);
            }
            }catch (\Exception $e){
                dump($header,$a);
                $fileExtension='erro'.uniqid();
            }
            $i++;
        }
        $a->file_location = str_slug($a->name) . '_' . uniqid() . $fileExtension;

        Storage::disk('local')->put('/public/'.$a->file_location, $body);
        return true;
    }
}