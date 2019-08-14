<?php

namespace App\Service\Entrada;

use App\Entity\Entrada\Entrada;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EntradaUseCaseAlta
{

    private $generateTags;
    private $repositoryEntrada;
    private $container;
    private $doctrine;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->doctrine = $container->getDoctrine();
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
        $entrada = $this->updateTagsCloud($entrada);

        $entrada = $this->EntradaAltaHandler
                ->setNext($altaEntrada)
                ->setNext($actualizarTags);

        return $entrada;
    }

    private function updateTagsCloud(Entrada $entrada): Entrada
    {
        $description = $entrada->getDescription();
        $tags = $this->generateTags->generate($description)->tags();
        if ($tags) {
            $entrada = $this->TagRepository->updateTagsCloud($tags, $entrada);
        }
        return $entrada;
    }

}
