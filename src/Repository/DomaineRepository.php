<?php

namespace Renolab\Rge\Repository;

use Renolab\Rge\Entity\Domaine;
use Renolab\Rge\Transformer\DomaineTransformer;

final class DomaineRepository
{
    protected static ?array $db = null;

    protected static function instance(): array
    {
        if (null === self::$db) {
            $json = \file_get_contents(__DIR__ . '/../../db/domaine.json');
            self::$db = \json_decode($json, true);
        }
        return self::$db;
    }

    /** @return array|Domaine[] */
    public function all(): array
    {
        return \array_map(function(array $item) {
            return DomaineTransformer::fromArray($item);
        }, self::instance());
    }

    public function find(string $domaine): ?Domaine
    {
        $results = \array_filter(self::instance(), function(array $item) use ($domaine) {
            return $item['nom'] === $domaine;
        });
        return \count($results) ? DomaineTransformer::fromArray(\reset($results)) : null;
    }
}
