<?php

namespace App\Service\Entrada;

use App\Entity\Entrada\Entrada;

class BloggerUseCaseConvertirEntrada
{

    private $container;
    private $doctrine;
    private $bloggerService;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->doctrine = $container->getDoctrine();
        $this->bloggerService = $container->get('bloggerService');
    }

    /**
     * @param string $name
     * @param string $description
     * @return Entrada
     */
    public function __invoke(
            string $url
    ): Entrada
    {

        $entradaBlogger = $this->bloggerService->getByUrl($url);
        $name = $entradaBlogger->title;
        $description = $entradaBlogger->description;
        
        $entrada = new Entrada($name, $description);
        $this->EntradaBlogger->guardar($entrada);
        $this->updateTagsCloud($entrada);



        return $entrada;
    }

    private function updateTagsCloud($entrada)
    {
        $this->repositoryTags->updateTagsCloud($entrada);
    }

}
