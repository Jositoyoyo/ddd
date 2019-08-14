<?php

namespace App\Service\Entrada;

use App\Entity\Entrada\Entrada;

class AltaEntradaAuto
{

    /**
     * @param string $name
     * @param string $description
     * @return Entrada
     */
    public function __invoke(): Entrada
    {

        $entradaBlogger = $this->bloggerService->getByUrl($url);
        $name = $entradaBlogger->title;
        $description = $entradaBlogger->description;
        
        $entrada = new Entrada($name, $description);
        $this->EntradaBlogger->guardar($entrada);
        $this->updateTagsCloud($entrada);



        return $entrada;
    }

    private function updateTagsCloud($entrada)
    {
        $this->repositoryTags->updateTagsCloud($entrada);
    }

}
