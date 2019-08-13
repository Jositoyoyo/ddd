<?php

namespace App\Entity\Entrada;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entradas
 *
 * @ORM\Table(name="entradas")
 * @ORM\Entity(repositoryClass="App\Repository\EntradasRepository") 
 */
class Entrada extends AbstractEntrada
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    protected $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    protected $description;

    /**
     * @var Tag[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Tags", cascade={"persist"})
     * @ORM\JoinTable(name="entradas_tags",
     *      joinColumns={@ORM\JoinColumn(name="id_entradas", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_tags", referencedColumnName="id")}
     *      )
     */
    protected $tags;

    /**
     * @param type $name
     * @param type $description
     */
    public function __construct($name, $description)
    {
        parent::__construct($name, $description);
        $this->tags = new ArrayCollection();
    }

    /**
     * @param \App\Entity\Entrada\Tags $tag
     * @return void
     */
    public function addTag(Tags $tag): void
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
    }

    /**
     * @param \App\Entity\Entrada\Tags $tag
     * @return void
     */
    public function removeTag(Tags $tag): void
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @return array
     */
    public function getTagsArray(): array
    {
        $tagsObject = $this->tags;
        $tags = [];
        foreach ($tagsObject as $tag) {
            $tags[] = $tag->getTag();
        }
        return $tags;
    }

    public function setTags($string)
    {
        $tags = $this->generateTags->generateTags($string);
    
    }

}
