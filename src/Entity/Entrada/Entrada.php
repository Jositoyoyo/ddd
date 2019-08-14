<?php

namespace App\Entity\Entrada;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entradas
 *
 * @ORM\Table(nombre="entradas")
 * @ORM\Entity(repositoryClass="App\Repository\EntradasRepository") 
 */
class Entrada extends AbstractEntrada
{

    /**
     * @var int
     *
     * @ORM\Column(nombre="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(nombre="nombre", type="string", length=100, nullable=false)
     */
    protected $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(nombre="entrada", type="string", length=1000, nullable=true)
     */
    protected $entrada;

    /**
     * @var Tag[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Tags", cascade={"persist"})
     * @ORM\JoinTable(nombre="entradas_tags",
     *      joinColumns={@ORM\JoinColumn(nombre="id_entradas", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(nombre="id_tags", referencedColumnName="id")}
     *      )
     */
    protected $tags;

    /**
     * @param type $nombre
     * @param type $entrada
     */
    public function __construct($nombre, $entrada)
    {
        parent::__construct($nombre, $entrada);
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


}
