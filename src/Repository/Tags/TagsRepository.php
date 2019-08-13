<?php

namespace App\Repository;

use App\Entity\Tags;
use App\Entity\Entradas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class TagsRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Tags::class);
    }
    /**
     * @param array $tags
     * @param \App\Repository\Entradas $entradas
     */
    public function updateTagsCloud(array $tags = null, Entradas $entradas): void {

        if ($tags) {
            
            foreach ($tags as $tag_item) {
                $tag = $this->findOneByTag($tag_item);
                if (!$tag) {
                    $tag = new Tags();
                    $tag->setTag($tag_item);
                    $entradas->addTag($tag);
                } else {
                    $entradas->addTag($tag);
                }
            }
            
            $em = $this->getEntityManager();
            $em->persist($entradas);
            $em->flush();

            $array_diff = array_diff($entradas->getTagsArray(), $tags);
            if ($array_diff) {
                
                foreach ($array_diff as $value) {
                    $entradas->removeTag($this->findOneByTag($value));
                }
                
                $em->persist($entradas);
                $em->flush();
                
            }
        }
    }

}
