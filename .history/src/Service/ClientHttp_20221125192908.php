<?php
namespace App\Service;

class ClientHttp{

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCodeUrl(string $url)
    {

   
    }
}