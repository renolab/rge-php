<?php

namespace Renolab\Rge;

use Renolab\Rge\Entity\Entreprise;
use Renolab\Rge\Exception\BadRequestException;
use Renolab\Rge\Repository\CommuneRepository;
use Renolab\Rge\Repository\DomaineRepository;
use Renolab\Rge\Repository\EntrepriseRepository;

class EntrepriseService implements EntrepriseInterface
{
    private ?CommuneRepository $communeRepository;
    private ?DomaineRepository $domaineRepository;
    private ?EntrepriseRepository $entrepriseRepository;

    public function __construct()
    {
        $this->communeRepository = CommuneRepository::create();
        $this->domaineRepository = new DomaineRepository();
        $this->entrepriseRepository = EntrepriseRepository::create();
    }

    public function find(string $siret, \DateTimeInterface $date): ?Entreprise
    {
        if (!\preg_match('/^\d{14}$/', $siret)) {
            throw new BadRequestException('Siret invalide');
        }
        return $this->entrepriseRepository->find($siret, $date);
    }

    public function search(string $nomDomaine, string $codeCommune, int $distance, ?int $page = 1): array
    {
        if (null === $domaine = $this->domaineRepository->find($nomDomaine)) {
            throw new BadRequestException('Domaine invalide');
        }
        if (null === $commune = $this->communeRepository->find($codeCommune)) {
            throw new BadRequestException('Commune invalide');
        }
        return $this->entrepriseRepository->search($domaine, $commune, $distance, $page);
    }
}
