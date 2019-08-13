<?php

namespace App\Utils\GenerateTags;

interface IGenerateTags
{
    public function tags(): array;
    public function generate(string $string): this;
}
