<?php
namespace App\Service;
use Symfony\Component\H

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