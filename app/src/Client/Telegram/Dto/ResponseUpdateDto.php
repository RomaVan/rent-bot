<?php

namespace App\Client\Telegram\Dto;

use DateTimeImmutable;

class ResponseUpdateDto
{
    private function __construct(
        private int $updateId,
        private int $messageId,
        private array $from,
        private DateTimeImmutable $date,
        private string $text,
    ) {}

    public static function createFromResponse(array $response): self
    {
        $message = $response['message'];
        $dateTime = new DateTimeImmutable($message['date']);
        return new self(
            $response['update_id'],
            $message['message_id'],
            $message['from'],
            $dateTime,
            $message['text']
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

    public function getFrom(): array
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

    public function toArray(): array
    {
        return [
            'updateId' => $this->getUpdateId(),
            'messageId' => $this->getMessageId(),
            'date' => $this->getDate()->getTimestamp(),
            'text' => $this->getText(),
            'from' => $this->getFrom(),
        ];
    }
}
