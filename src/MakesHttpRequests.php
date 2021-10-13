<?php

namespace MailChecker\PhpSdk;

use Exception;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

trait MakesHttpRequests
{
    protected function get(string $uri, $queryParams = [])
    {
        return $this->request('GET', $uri, $queryParams);
    }

    protected function request(string $verb, string $uri, array $queryParams = [])
    {
        $response = $this->client->request(
            $verb,
            $uri,
            empty($queryParams) ? [] : [RequestOptions::QUERY => $queryParams]
        );

        if (! $this->isSuccessful($response)) {
            return $this->handleRequestError($response);
        }

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

    public function isSuccessful($response): bool
    {
        if (! $response) {
            return false;
        }

        return (int) substr($response->getStatusCode(), 0, 1) === 2;
    }

    protected function handleRequestError(ResponseInterface $response): void
    {
        throw new Exception((string) $response->getBody());
    }
}
