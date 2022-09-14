<?php

namespace Renolab\Rge\Transformer;

use Renolab\Rge\Entity\Domaine;
use Renolab\Rge\Entity\Entreprise;
use Renolab\Rge\Entity\Qualification;

class EntrepriseTransformer
{
    private const ENTREPRISE_MAP = [
        'siret', 'nom_entreprise', 'adresse', 'code_postal', 'commune', 'latitude', 'longitude', 'particulier'
    ];
    private const QUALIFICATION_MAP = [
        'domaine', 'meta_domaine', 'organisme', 'code_qualification', 'nom_certificat', 'nom_qualification', 'url_qualification'
    ];

    public static function fromResponse(array $lines)
    {
        $entity = null;
        $qualifications = [];
    
        foreach ($lines as $line) {
            if (self::check(self::ENTREPRISE_MAP, $line) && !$entity) {
                $entity = $line;
            }
            if (self::check(self::QUALIFICATION_MAP, $line)) {
                $qualifications[] = self::transformQualification($line);
            }
        }
        return new Entreprise(
            $entity['siret'],
            $entity['nom_entreprise'],
            $entity['adresse'],
            $entity['code_postal'],
            $entity['commune'],
            (float) $entity['latitude'],
            (float) $entity['longitude'],
            $entity['particulier'] ?? null,
            $entity['email'] ?? null,
            $entity['telephone'] ?? null,
            $entity['site_internet'] ?? null,
            $qualifications,
        );
    }

    private static function transformQualification(array $item): Qualification
    {
        return new Qualification(
            $item['code_qualification'],
            $item['nom_qualification'],
            $item['organisme'],
            $item['nom_certificat'],
            $item['url_qualification'],
            \array_key_exists('lien_date_debut', $item) ? new \DateTime($item['lien_date_debut']) : null,
            \array_key_exists('lien_date_fin', $item) ? new \DateTime($item['lien_date_fin']) : null,
            new Domaine($item['domaine'], $item['meta_domaine'])
        );
    }

    private static function check(array $map, array $data): bool
    {
        foreach ($map as $key) {
            if (!\array_key_exists($key, $data) || null === $data[$key]) {
                return false;
            }
        }
        return true;
    }
}

