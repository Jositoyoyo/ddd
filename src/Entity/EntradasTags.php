<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntradasTags
 *
 * @ORM\Table(name="entradas_tags", uniqueConstraints={@ORM\UniqueConstraint(name="entradas_tags_UNIQUE", columns={"id_tags", "id_entradas"})}, indexes={@ORM\Index(name="fk_entradas_tags_id_entradas_idx", columns={"id_entradas"}), @ORM\Index(name="fk_entradas_tags_id_tags_idx", columns={"id_tags"})})
 * @ORM\Entity
 */
class EntradasTags {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Entradas
     *
     * @ORM\ManyToOne(targetEntity="Entradas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_entradas", referencedColumnName="id")
     * })
     */
    private $entradas;

    /**
     * @var \Tags
     *
     * @ORM\ManyToOne(targetEntity="Tags")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tags", referencedColumnName="id")
     * })
     */
    private $tags;

    public function getId() {
        return $this->id;
    }

    public function getEntradas() {
        return $this->entradas;
    }

    public function setEntradas(Entradas $entradas) {
        $this->entradas = $entradas;
        return $this;
    }

    public function getTags() {
        return $this->tags;
    }

    public function setTags(Tags $tags) {
        $this->tags = $tags;
        return $this;
    }

}
