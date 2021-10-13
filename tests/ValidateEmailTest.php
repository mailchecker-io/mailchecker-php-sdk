<?php

namespace MailChecker\PhpSdk\Tests;

use MailChecker\PhpSdk\MailChecker;
use MailChecker\PhpSdk\Resources\Email;

class ValidateEmailTest extends TestCase
{
    const VALID_EMAIL   = 'hello@mailchecker.io';
    const INVALID_EMAIL = 'goodbye@mailchecker.io';

    public function test_instantiate_an_object()
    {
        $sdk = new MailChecker('api-token');

        $this->assertTrue(is_object($sdk));
    }

    public function test_validate_invalid_email()
    {
        $checkedEmail = $this->mailChecker->validateEmail(self::INVALID_EMAIL);

        $this->assertInstanceOf(Email::class, $checkedEmail);
        $this->assertSame($checkedEmail->getEmail(), self::INVALID_EMAIL);
        $this->assertFalse($checkedEmail->isDeliverable());
    }

    public function test_validate_valid_email()
    {
        $checkedEmail = $this->mailChecker->validateEmail(self::VALID_EMAIL);

        $this->assertInstanceOf(Email::class, $checkedEmail);
        $this->assertSame($checkedEmail->getEmail(), self::VALID_EMAIL);
        $this->assertTrue($checkedEmail->isDeliverable());
    }
}
