<?php

namespace App\Entity\Entrada;

abstract class AbstractAdysaGroup
{

    protected $id;
    protected $title;
    protected $url;

    public function __construct($title, $url)
    {
        $this->title = $title;
        $this->url = $url;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getUrl()
    {
        return $this->url;
    }

}
