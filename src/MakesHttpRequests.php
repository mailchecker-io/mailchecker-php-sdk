<?php

namespace MailChecker\PhpSdk;

use Exception;
use Psr\Http\Message\ResponseInterface;

trait MakesHttpRequests
{
    protected function get(string $uri)
    {
        return $this->request('GET', $uri);
    }

    protected function request(string $verb, string $uri)
    {
        $response = $this->client->request(
            $verb,
            $uri
        );

        if (!$this->isSuccessful($response)) {
            return $this->handleRequestError($response);
        }

        $responseBody = (string)$response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

    public function isSuccessful($response): bool
    {
        if (!$response) {
            return false;
        }

        return (int)substr($response->getStatusCode(), 0, 1) === 2;
    }

    protected function handleRequestError(ResponseInterface $response): void
    {
        throw new Exception((string)$response->getBody());
    }
}
