<?php

namespace App\Entity\Entrada;

abstract class AbstractEntrada
{

    protected $id;
    protected $estado;
    protected $nombre;
    protected $slug;
    protected $entrada;
    protected $herramienta;
    protected $categoria;
    protected $tags;

    public function __construct(
            $name,
            $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getEntrada()
    {
        return $this->entrada;
    }

    public function getHerramienta()
    {
        return $this->herramienta;
    }

    abstract public function removeTag(): void;

    abstract public function getTags();

    abstract public function getTagsArray(): array;
}
