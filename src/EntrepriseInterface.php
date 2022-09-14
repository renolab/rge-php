<?php

namespace Renolab\Rge;

use Renolab\Rge\Entity\Entreprise;

interface EntrepriseInterface
{
    public function find(string $siret, \DateTimeInterface $date): ?Entreprise;
    public function search(string $nomDomaine, string $codeCommune, int $distance, ?int $page = 1): array;
}
