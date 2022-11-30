<?php
namespace App\Service;
use Symfony\Component\HttpClient\HttpClient; 

class ClientHttp{

    private $clientHttp;

    public function __construct()
    {
       $this->clientHttp = HttpClient::create();
    }

    public function getCodeUrl(string $url)
    {
       $codeHttp = null;

       
       $response = $this->clientHttp->request('GET', $url);
       $codeHttp = $response->getStatusCode();

         return $codeHttp;


   
    }
}