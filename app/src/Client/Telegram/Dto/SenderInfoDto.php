<?php declare(strict_types=1);

namespace App\Client\Telegram\Dto;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Embeddable;

/** @Embeddable */
final class SenderInfoDto
{
    private function __construct(
        /** @Column(type = "integer") */
        private int $senderId,
        /** @Column(type = "boolean") */
        private bool $isBot,
        /** @Column(type = "string") */
        private string $firstName,
        /** @Column(type = "string") */
        private ?string $lastName,
        /** @Column(type = "string") */
        private string $username,
        /** @Column(type = "string") */
        private string $language,
    ) {}

    public static function createFromResponse(array $response): self
    {
        return new self(
            $response['id'],
            $response['is_bot'],
            $response['first_name'],
            $response['last_name'],
            $response['username'],
            $response['language_code'],
        );
    }

    public static function createEmpty(): self
    {
        return new self(
            0,
            false,
            '',
            '',
            '',
            '',
        );
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function isBot(): bool
    {
        return $this->isBot;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}
