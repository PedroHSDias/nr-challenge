<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 05/05/2018
 * Time: 22:33
 */

namespace App\Business;


abstract class Crawler
{
    protected $allHTML;
    protected $body;
    protected $url='';
    protected $currentPage=1;

    /**
     * Crawler constructor.
     */
//    public function __construct()
//    {
//        echo $this->url;
//    }

    public abstract function getGenericBiddings();

    /**
     * @return boolean
     */
    public abstract function isLastPage();

    /**
     * @param $url
     * @param array $parameters
     * @param bool $post
     * @return mixed
     * @throws \Exception
     */
    public function catchHtml($parameters=[], $post=false){

        $ch = curl_init();
        $query='';
        $curlConfig=[];

        if($post) {
            $curlConfig[CURLOPT_POSTFIELDS]=$parameters;
        }else{
            $query .= '?'.http_build_query($parameters);
        }
//        $this->todoHtml=$this->ler();
//        return;
        $curlConfig +=array(
            CURLOPT_URL            => $this->url.$query,
            CURLOPT_POST           => $post,
            CURLOPT_SSL_VERIFYHOST=> false,
            CURLOPT_SSL_VERIFYPEER=> false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        );
        curl_setopt_array($ch, $curlConfig);
        $this->allHTML = curl_exec($ch);
        $curlError=curl_errno($ch);
        if($curlError || !$this->allHTML)
        {
            throw new \Exception('Curl erro:' . curl_error($ch));
        }
        curl_close($ch);
    }
    protected function onlyBody(){
        /*<(.|\s)+?> regex para todas as tags*/
        $this->body=preg_split('/<(\/body|body.+)+?/',$this->allHTML)[1];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function toArray(){
        $this->onlyBody();
        return [
            'URL'=>$this->url
            ,'Pagina atual'=>$this->currentPage
            ,'Body'=>$this->body
        ];
    }
    public function gravar($texto)
    {
        $arquivo = 'meu_arquivo_'.$this->currentPage.'.txt';
        $fp = fopen($arquivo, "a+");
        fwrite($fp, $texto);
        fclose($fp);
    }
    public function ler(){
        $arquivo = 'meu_arquivo_'.$this->currentPage.'.txt';
        $fp = fopen($arquivo, "r");
        $conteudo = fread($fp, filesize($arquivo));

        fclose($fp);
        return $conteudo;
    }
}
