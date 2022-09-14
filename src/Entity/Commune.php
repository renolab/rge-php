<?php

namespace Renolab\Rge\Entity;

class Commune
{
    public function __construct(public readonly string $code, public readonly string $nom, public readonly array $points) {}

    public function longitude(): ?float
    {
        return $this->points[0] ?? null;
    }

    public function latitude(): ?float
    {
        return $this->points[1] ?? null;
    }
}
