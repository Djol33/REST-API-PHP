<?php

namespace App\HTTPClient;

class HTTPClient
{
    private $curl;
    private $url;
    public function __construct($url)
    {
     $this->url=$url;

        $this->curl = curl_init($url);
    }

    public function get()
    {


    }
    public function post($params){
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        $a =  curl_exec($this->curl);
        if(curl_errno($this->curl)) {
            curl_close($this->curl);

            return 'cURL error: ' . curl_error($this->curl);
        } else {
            curl_close($this->curl);

            $result = json_decode($a, true);
            return ($result);
        }

    }

}