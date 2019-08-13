<?php

namespace App\Service\Entrada;

use App\Entity\Tags;
use App\Entity\Entrada\Entrada;

class EntradaUseCaseAlta
{

    private $repositoryTag;
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

        try {
            $this->repositoryEntrada->guardar($entrada);
        } catch (\PDOException $ex) {
            echo "Error : " . $ex->getMessage();
        }
        $this->updateTagsCloud($entrada);
        return $entrada;
    }

    private function updateTagsCloud($entrada)
    {
        $this->repositoryTags->updateTagsCloud($entrada);
    }

}
