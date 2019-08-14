<?php

namespace App\Service\Entrada\Handler;

class AltaEntradaHandler extends AbstractHandler
{
    public function handle(Entrada $entrada): ?Entrada
    {
        if ($entrada) {
            return $entrada;
        } else {
            return parent::handle($request);
        }
    }

}
