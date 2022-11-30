<?php
namespace App\Service;
use Symfony\Component\HttpClien

class ClientHttp{

    private $clientHttp;

    public function __construct()
    {
       $this->clientHttp = HttpClient::create();
    }

    public function getCodeUrl(string $url)
    {
       
   
    }
}