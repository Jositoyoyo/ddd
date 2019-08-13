<?php

namespace App\Service\Entrada;

use Symfony\Component\DependencyInjection\ContainerInterface;

class EntradaUseCase
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function alta(
            string $name,
            string $description): EntradaUseCaseAlta
    {
        $alta = new EntradaUseCaseAlta($this->container);
        return $alta($name, $description);
    }

    public function borrar(
            Entrada $entrada): EntradaUseCaseBaja
    {
        $alta = new EntradaUseCaseAlta($this->container);
        return $alta->__invoke($entrada);
    }

}
