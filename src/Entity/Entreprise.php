<?php

namespace Renolab\Rge\Entity;

class Entreprise
{
    public function __construct(
        public readonly string $siret,
        public readonly string $raisonSociale,
        public readonly string $adresse,
        public readonly string $codePostal,
        public readonly string $commune,
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly ?bool $particulier,
        public readonly ?string $telephone,
        public readonly ?string $email,
        public readonly ?string $siteInternet,
        public readonly array $qualifications = []
    ) {}
}
