<?php

namespace App\Service\Bloggeer;

use App\Service\Blogger\BloggerUseCase;
use Symfony\Component\HttpClient\CurlHttpClient;

class BloggerListarEntradas extends BloggerUseCase
{

    /**
     * @return CurlHttpClient
     */
    public function __invoke(): CurlHttpClient
    {
        return $this->httpClient
                        ->request('GET', 'http://releases.ubuntu.com/18.04.2/ubuntu-18.04.2-desktop-amd64.iso');
    }

}
