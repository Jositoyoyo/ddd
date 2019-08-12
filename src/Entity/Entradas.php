<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entradas
 *
 * @ORM\Table(name="entradas")
 * @ORM\Entity(repositoryClass="App\Repository\EntradasRepository") 
 */
class Entradas {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var Tag[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Tags", cascade={"persist"})
     * @ORM\JoinTable(name="entradas_tags",
     *      joinColumns={@ORM\JoinColumn(name="id_entradas", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_tags", referencedColumnName="id")}
     *      )
     */
    private $tags;

    public function __construct() {
        $this->tags = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription(string $description) {
        $this->description = $description;
        return $this;
    }

    public function addTag(Tags $tag): void {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
    }

    public function removeTag(Tags $tag): void {
        $this->tags->removeElement($tag);
    }

    public function getTags(): Collection {
        return $this->tags;
    }

    /**
     * @return array
     */
    public function getTagsArray() : array {
        $tagsObject = $this->tags;
        $tags = [];
        foreach ($tagsObject as $tag) {
            $tags[] = $tag->getTag();
        }
        return $tags;        
    }

}
