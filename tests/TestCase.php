<?php

namespace MailChecker\PhpSdk\Tests;

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected MailChecker $mailChecker;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadEnvironmentVariables();

        $this->mailChecker = new MailChecker();
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
