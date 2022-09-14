<?php

namespace Renolab\Rge\Transformer;

use Renolab\Rge\Entity\Commune;

class CommuneTransformer
{
    public static function fromArray(array $commune): Commune
    {
        return new Commune($commune['code'], $commune['nom'], $commune['centre']['coordinates']);
    }
}
