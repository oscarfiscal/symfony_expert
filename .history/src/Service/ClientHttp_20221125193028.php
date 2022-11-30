<?php
namespace App\Service;

class ClientHttp{

    private $clientHttp;

    public function __construct()
    {
       $this->clientHttp = new \GuzzleHttp\Client();
    }

    public function getCodeUrl(string $url)
    {
        $this
   
    }
}