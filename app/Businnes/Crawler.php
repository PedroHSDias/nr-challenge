<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 05/05/2018
 * Time: 22:33
 */

namespace App\Businnes;


abstract class Crawler
{
    protected $todoHtml;
    protected $body;
    protected $url='';
    protected $paginaAtual=1;

    /**
     * Crawler constructor.
     */
//    public function __construct()
//    {
//        echo $this->url;
//    }


    public abstract function getLicitacoes();

    /**
     * @return boolean
     */
    public abstract function isUltimaPagina();

    /**
     * @param $url
     * @param array $parametros
     * @param bool $post
     * @return mixed
     * @throws \Exception
     */
    public function catchHtml($parametros=[], $post=false){

        $ch = curl_init();
        $query='?';
        $curlConfig=[];

        if($post) {
            $curlConfig[CURLOPT_POSTFIELDS]=$parametros;
        }else{
            $query .= http_build_query($parametros);
        }

        $curlConfig +=array(
            CURLOPT_URL            => $this->url.$query,
            CURLOPT_POST           => $post,
            //CURLOPT_HEADER         => true,
            CURLOPT_SSL_VERIFYHOST=> false,
            CURLOPT_SSL_VERIFYPEER=> false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_CONNECTTIMEOUT=>5,
//            CURLOPT_TIMEOUT=>5,
        );
        curl_setopt_array($ch, $curlConfig);
        $this->todoHtml = curl_exec($ch);
//        $curlStatus=curl_getinfo($ch,CURLINFO_HTTP_CODE);
        $curlErro=curl_errno($ch);
        if($curlErro || !$this->todoHtml)
        {
            throw new \Exception('Curl erro:' . curl_error($ch));
        }
        curl_close($ch);
    }
    protected function onlyBody(){
        /*<(.|\s)+?> regex para todas as tags*/
        $this->body=preg_split('/<(\/body|body.+)+?/',$this->todoHtml)[1];
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
    public function getPaginaAtual()
    {
        return $this->paginaAtual;
    }

    public function toArray(){
        $this->onlyBody();
        return [
            'URL'=>$this->url
            ,'Pagina atual'=>$this->paginaAtual
            ,'Body'=>$this->body
        ];
    }
}
