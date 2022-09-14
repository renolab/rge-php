<?php

namespace Renolab\Rge\Services;

use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    public function request(string $method, $uri = '', array $options = []): ResponseInterface;
}
