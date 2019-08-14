<?php

namespace App\Service\Blogger;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpClient\CurlHttpClient;

abstract class BloggerUseCase
{

    protected $container;
    protected $httpClient;
    protected $bloggerId;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->httpClient = new CurlHttpClient();
    }

}
