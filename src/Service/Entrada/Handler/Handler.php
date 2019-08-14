<?php

namespace App\Service\Entrada\Handler;

use App\Entity\Entrada\Entrada;

interface Handler
{
    public function setNext(Handler $handler): Handler;
    public function handle(Entrada $entrada) : ?Entrada;
}
