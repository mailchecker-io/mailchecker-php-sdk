<?php

namespace MailChecker\PhpSdk\Tests;

use MailChecker\PhpSdk\MailChecker;

class ValidateEmailTest extends TestCase
{
    public function test_instantiate_an_object()
    {
        $sdk = new MailChecker('api-token');

        $this->assertTrue(is_object($sdk));
    }
}
