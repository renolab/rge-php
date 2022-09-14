<?php

namespace Renolab\Rge;

use Renolab\Rge\Entity\Domaine;

interface DomaineInterface
{
    public function all(): array;
    public function find(string $nom): ?Domaine;
}
