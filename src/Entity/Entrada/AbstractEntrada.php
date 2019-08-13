<?php

namespace App\Entity\Entrada;

abstract class AbstractEntrada
{

    protected $id;
    protected $name;
    protected $description;
    protected $tags;
    protected $generateTags;

    public function __construct($name, $description, $config)
    {
        $this->name = $name;
        $this->description = $description;
        $this->generateTags = new \App\Utils\GenerateTags\GenerateTags($config);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    abstract public function removeTag(): void;

    abstract public function getTags();

    /**
     * @return array
     */
    abstract public function getTagsArray(): array;



}
