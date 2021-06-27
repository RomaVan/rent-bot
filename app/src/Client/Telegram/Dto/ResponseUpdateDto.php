<?php

namespace App\Client\Telegram\Dto;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Embeddable;
use Cycle\Annotated\Annotation\Relation\Embedded;
use DateTimeImmutable;

/** @Embeddable */
final class ResponseUpdateDto
{
    private function __construct(
        /** @Column(type = "integer") */
        private int $updateId,
        /** @Column(type = "integer") */
        private int $messageId,
        /** @Column(type = "datetime") */
        private DateTimeImmutable $date,
        /** @Column(type = "string") */
        private string $text,
        private SenderInfoDto $from,
        /** @Column(type = "integer") */
        private ?int $chatId,
        /** @Column(type = "string") */
        private ?string $username,
    ) {}

    public static function createFromResponse(array $response): self
    {
        $message = $response['message'];
        $dateTime = (new DateTimeImmutable())->setTimestamp($message['date']);
        return new self(
            $response['update_id'],
            $message['message_id'],
            $dateTime,
            $message['text'],
            SenderInfoDto::createFromResponse($message['from']),
            $message['from']['id'],
            $message['from']['username'],
        );
    }

    public static function createEmpty(): self
    {
        return new self(
            0,
            0,
            new DateTimeImmutable(),
            '',
            SenderInfoDto::createEmpty(),
            null,
            null
        );
    }

    public function getUpdateId(): int
    {
        return $this->updateId;
    }

    public function getMessageId(): int
    {
        return $this->messageId;
    }

    public function getFrom(): SenderInfoDto
    {
        return $this->from;
    }

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getChatId(): ?int
    {
        return $this->chatId;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }
}
