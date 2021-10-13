<?php

namespace MailChecker\PhpSdk;

use Carbon\Carbon;
use GuzzleHttp\Client;

class MailChecker
{
    use MakesHttpRequests;

    public string $apiToken;

    public Client $client;

    public function __construct(string $apiToken, string $baseUri = 'https://app.mailchecker.io/api/')
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
}
