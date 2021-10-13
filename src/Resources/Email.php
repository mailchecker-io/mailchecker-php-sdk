<?php

namespace MailChecker\PhpSdk\Resources;

class Email extends ApiResource
{
    protected array   $checks;

    protected bool    $deliverable;

    protected ?string $didYouMean;

    protected string  $email;

    protected array   $helpers;

    /**
     * @return array
     */
    public function getChecks(): array
    {
        return $this->checks;
    }

    /**
     * @return string|null
     */
    public function getDidYouMean(): ?string
    {
        return $this->didYouMean;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function getHelpers(): array
    {
        return $this->helpers;
    }

    /**
     * @return bool
     */
    public function isDeliverable(): bool
    {
        return $this->deliverable;
    }
}
