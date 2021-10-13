<?php

class Email extends ApiResource
{
    protected string $email;
    protected bool $deliverable;
    protected string $didYouMean;
    protected array $helpers;
}
