<?php

namespace MailChecker\PhpSdk\Exceptions;

use Exception;

class EmailValidationException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid email address supplied');
    }
}
