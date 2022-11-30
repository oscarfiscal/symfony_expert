<?php
namespace App\Service;
use Symfony\Compo

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