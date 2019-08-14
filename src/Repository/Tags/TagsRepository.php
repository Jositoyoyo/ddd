<?php

namespace App\Repository;

use App\Entity\Tag;
use App\Entity\Entrada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class TagRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tags::class);
    }

    /**
     * @param array $tags
     * @param \App\Repository\Entradas $entrada
     */
    public function updateTagsCloud(array $tags = null, Entrada $entrada): Entrada
    {
        if ($tags) {
            foreach ($tags as $tag_item) {
                $tag = $this->findOneByTag($tag_item);
                if (!$tag) {
                    $tag = new Tag();
                    $tag->setTag($tag_item);
                    $entrada->addTag($tag);
                } else {
                    $entrada->addTag($tag);
                }
            }

            $em = $this->getEntityManager();
            $em->persist($entrada);
            $em->flush();

            $array_diff = array_diff($entrada->getTagsArray(), $tags);
            if ($array_diff) {

                foreach ($array_diff as $value) {
                    $entrada->removeTag($this->findOneByTag($value));
                }

                $em->persist($entrada);
                $em->flush();
            }
        }
        return $entrada;
    }

}
