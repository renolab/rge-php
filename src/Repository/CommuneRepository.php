<?php

namespace Renolab\Rge\Repository;

use Renolab\Rge\Entity\Commune;
use Renolab\Rge\Services\HttpClient;
use Renolab\Rge\Services\HttpClientInterface;
use Renolab\Rge\Transformer\CommuneTransformer;

final class CommuneRepository
{
    private function __construct(private HttpClientInterface $client) {}

    public static function create(): self
    {
        return new self(HttpClient::create());
    }

    public function find(string $code): ?Commune
    {
        $response = $this->client->request('GET', 'https://geo.api.gouv.fr/communes/' . $code, [
            'query' => ['fields' => 'code,nom,centre']
        ]);

        if ($response->getStatusCode() === 200) {
            $content = \json_decode((string) $response->getBody(), true);
            return CommuneTransformer::fromArray($content);
        }
        return null;
    }
}
