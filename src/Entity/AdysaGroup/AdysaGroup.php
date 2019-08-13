<?php

namespace App\Entity\Entrada;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdysaGroup
 *
 * @ORM\Table(name="adysaGroup")
 * @ORM\Entity(repositoryClass="App\Repository\AdysaGroupRepository") 
 */
class AdysaGroup extends AbstractAdysaGroup
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
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    protected $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=256, nullable=true)
     */
    protected $url;

}
