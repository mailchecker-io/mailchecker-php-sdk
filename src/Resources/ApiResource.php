<?php

namespace MailChecker\PhpSdk\Resources;

use function Couchbase\defaultDecoder;

abstract class ApiResource
{
    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $key = $this->camelCase($key);

            if (property_exists(static::class, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    protected function camelCase(string $key): string
    {
        $parts = explode('_', $key);

        foreach ($parts as $i => $part) {
            if ($i !== 0) {
                $parts[$i] = ucfirst($part);
            }
        }

        return str_replace(' ', '', implode(' ', $parts));
    }
}
