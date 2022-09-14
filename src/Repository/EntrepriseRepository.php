<?php

namespace Renolab\Rge\Repository;

use Renolab\Rge\Entity\Commune;
use Renolab\Rge\Entity\Domaine;
use Renolab\Rge\Entity\Entreprise;
use Renolab\Rge\Services\HttpClient;
use Renolab\Rge\Services\HttpClientInterface;
use Renolab\Rge\Transformer\EntrepriseTransformer;

final class EntrepriseRepository
{
    private function __construct(private HttpClientInterface $client) {}

    public static function create(): self
    {
        return new self(HttpClient::create());
    }

    public function find(string $siret, \DateTimeInterface $date): ?Entreprise
    {
        $qs = \str_replace(
            ['_SIRET', '_DATE'],
            [$siret, $date->format('Y-m-d')],
            'siret:"_SIRET" AND lien_date_debut:{* TO _DATE} AND lien_date_fin:{_DATE TO *}'
        );

        $response = $this->client->request('GET', 'https://data.ademe.fr/data-fair/api/v1/datasets/historique-rge/lines', [
            'query' => ['size' => 100, 'qs' => $qs]
        ]);

        if ($response->getStatusCode() === 200) {
            $content = \json_decode((string) $response->getBody(), true);
            if ($content['total']) {
                return EntrepriseTransformer::fromResponse($content['results']);
            }
        }
        return null;
    }

    public function search(Domaine $domaine, Commune $commune, int $distance, ?int $page = 1): array
    {
        $q = 'domaine:"'. $domaine->nom .'"';
        $geo = $commune->longitude() . ',' . $commune->latitude() . ',' . $distance . 'km';

        $response = $this->client->request('GET', 'https://data.ademe.fr/data-fair/api/v1/datasets/liste-des-entreprises-rge-2/lines', [
            'query' => ['size' => 100, 'page' => $page, 'q' => $q, 'geo_distance' => $geo, 'collapse' => 'siret']
        ]);

        if ($response->getStatusCode() === 200) {
            $content = \json_decode((string) $response->getBody(), true);
            if ($content['total']) {
                return \array_map(function(array $item) {
                    return EntrepriseTransformer::fromResponse([$item]);
                }, $content['results']);
            }
        }

        return [];
    }
}
