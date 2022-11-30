<?php
namespace App\Service;

class ClientHttp{

    public function __construct()
    {
        $this->client = HttpClient::create();
    }
    public function getCodeUrl(string $url)
    {

   
    }
}