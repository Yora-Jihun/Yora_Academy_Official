<?php

namespace App\Events;

class OtpLocked
{
    /**
     * @param  array<string, mixed>  $metadata
     */
    public function __construct(
        public string $email,
        public ?string $ip = null,
        public ?string $userAgent = null,
        public array $metadata = []
    ) {}
}
