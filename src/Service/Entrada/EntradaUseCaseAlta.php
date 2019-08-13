<?php

namespace App\Service\Entrada;

use App\Entity\Tags;
use App\Entity\Entrada\Entrada;

class EntradaUseCaseAlta
{

    private $generateTags;
    private $repositoryEntrada;
    private $container;

    public function __construct()
    {
        $this->doctrine = $this->container->getDoctrine()
                ->getRepository(Tags::class);
    }

    /**
     * @param string $name
     * @param string $description
     * @return Entrada
     */
    public function __invoke(
            string $name,
            string $description
    ): Entrada
    {

        $entrada = new Entrada($name, $description);

        $this->repositoryEntrada->guardar($entrada);
        $this->updateTagsCloud($entrada);
        
        return $entrada;
        
    }

    private function updateTagsCloud(Entrada $entrada)
    {
        $description = $entrada->getDescription();
        $tags = $this->generateTags->generate($description)->tags();
        $this->Tag->updateTagsCloud($tags, $entrada);
    }

}
