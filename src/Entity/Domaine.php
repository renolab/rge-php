<?php

namespace Renolab\Rge\Entity;

class Domaine
{
    public function __construct(public readonly string $nom, public readonly string $famille) {}
}
