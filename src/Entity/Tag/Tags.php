<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tags
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity(repositoryClass="App\Repository\TagsRepository") 
 */
class Tags {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=65, nullable=false)
     */
    private $tag;

    public function getId() {
        return $this->id;
    }

    public function getTag() {
        return $this->tag;
    }

    public function setTag(string $tag) {
        $this->tag = $tag;
        return $this;
    }

}
