<?php

namespace Renolab\Rge\Entity;

class Qualification
{
    public function __construct(
        public readonly string $code,
        public readonly string $nom,
        public readonly string $organisme,
        public readonly string $certificat,
        public readonly string $url,
        public readonly ?\DateTimeInterface $dateDebut,
        public readonly ?\DateTimeInterface $dateFin,
        public readonly Domaine $domaine
    ) {}
}
