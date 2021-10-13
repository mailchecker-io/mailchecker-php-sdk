<?php

namespace MailChecker\PhpSdk;

use GuzzleHttp\Client;
use MailChecker\PhpSdk\Resources\Email;

class MailChecker
{
    use MakesHttpRequests;

    public string $apiToken;

    public Client $client;

    public function __construct(string $apiToken, string $baseUri = 'https://app.mailchecker.io/api')
    {
        $this->apiToken = $apiToken;

        $this->client = new Client([
            'base_uri'    => $baseUri,
            'http_errors' => false,
            'verify'      => false,
            'headers'     => [
                'Authorization' => "Bearer {$this->apiToken}",
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ],
        ]);
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function validateEmail(string $email): Email
    {
        $result = $this->get("validate", [
            'email' => $email,
        ]);

        return new Email($result);
    }
}
