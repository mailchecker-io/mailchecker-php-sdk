<?php

namespace MailChecker\PhpSdk;

use Exception;
use MailChecker\PhpSdk\Exceptions\EmailValidationException;
use Psr\Http\Message\ResponseInterface;

trait MakesHttpRequests
{
    protected function get(string $uri)
    {
        return $this->request('GET', $uri);
    }

    protected function post(string $uri, array $payload = [])
    {
        return $this->request('POST', $uri, $payload);
    }

    protected function put(string $uri, array $payload = [])
    {
        return $this->request('PUT', $uri, $payload);
    }

    protected function delete(string $uri, array $payload = [])
    {
        return $this->request('DELETE', $uri, $payload);
    }

    protected function request(string $verb, string $uri, array $payload = [])
    {
        $response = $this->client->request(
            $verb,
            $uri,
            empty($payload) ? [] : ['form_params' => $payload]
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
        if ($response->getStatusCode() === 422) {
            throw new EmailValidationException();
        }

        if ($response->getStatusCode() === 404) {
            throw new NotFoundException();
        }

        if ($response->getStatusCode() === 400) {
            throw new FailedActionException((string) $response->getBody());
        }

        throw new Exception((string) $response->getBody());
    }
}
