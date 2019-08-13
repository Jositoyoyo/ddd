<?php

namespace App\Service\Entrada;

use App\Entity\Tags;
use App\Entity\Entrada\Entrada;

class TagUseCaseUpdateTagsCloud
{

    private $repositoryTag;
    private $generateTags;

    public function __construct()
    {
        $this->repositoryTag = $this->getDoctrine()
                ->getRepository(Tags::class);
        $this->generateTags = new GenerateTags();
    }

    public function __invoke(Entrada $entrada)
    {
        $description = $entrada->getDescription();
        $tags = $this->generateTags->generate($description)->tags();
        $this->repositoryTag->updateTagsCloud($tags, $entrada);
    }

}
