<?php

namespace Renolab\Rge;

use Renolab\Rge\Entity\Domaine;
use Renolab\Rge\Repository\DomaineRepository;

class DomaineService implements DomaineInterface
{
    private DomaineRepository $repository;

    public function __construct()
    {
        $this->repository = new DomaineRepository();
    }

    public function all(): array
    {
        return $this->repository->all();
    }

    public function find(string $nom): ?Domaine
    {
        return $this->repository->find($nom);
    }
}
