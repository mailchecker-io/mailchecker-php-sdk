<?php

namespace MailChecker\PhpSdk\Tests;

use Dotenv\Dotenv;
use MailChecker\PhpSdk\MailChecker;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected MailChecker $mailChecker;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadEnvironmentVariables();

        $apiToken = getenv('API_TOKEN');
        $baseUri  = getenv('MAIL_CHECKER_API_URL');

        $this->mailChecker = new MailChecker($apiToken, $baseUri);
    }

    protected function loadEnvironmentVariables()
    {
        if (!file_exists(__DIR__ . '/../.env')) {
            return;
        }

        $dotEnv = Dotenv::createImmutable(__DIR__ . '/..');

        $dotEnv->load();
    }
}
