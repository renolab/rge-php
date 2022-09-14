<?php

namespace Renolab\Rge\Services;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class HttpClient implements HttpClientInterface
{
    private function __construct(private ClientInterface $client) {}

    public static function create(): HttpClientInterface
    {
        return new self(new Client());
    }

    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        return $this->client->request($method, $uri, $options);
    }
}
