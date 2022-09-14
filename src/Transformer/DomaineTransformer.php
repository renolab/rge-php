<?php

namespace Renolab\Rge\Transformer;

use Renolab\Rge\Entity\Domaine;

class DomaineTransformer
{
    public static function fromArray(array $domaine): Domaine
    {
        return new Domaine($domaine['nom'], $domaine['famille']);
    }
}