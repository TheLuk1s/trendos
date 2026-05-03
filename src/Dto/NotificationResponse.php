<?php

declare(strict_types=1);

namespace App\Dto;

final readonly class NotificationResponse
{
    public function __construct(
        public string $title,
        public string $description,
        public string $cta,
    ) {}

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'cta' => $this->cta,
        ];
    }
}
