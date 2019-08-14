<?php

namespace App\Service\Entrada\Handler;

use App\Entity\Entrada\Entrada;

abstract class AbstractHandler implements Handler
{

    /**
     * @var Handler
     */
    private $nextHandler;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(Entrada $entrada): ?Entrada
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($request);
        }

        return null;
    }

}
