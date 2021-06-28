<?php

namespace App\Client\Telegram\Dto;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Embeddable;
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
            SenderInfoDto::createFromResponse($message['from'])
        );
    }

    public static function createEmpty(): self
    {
        return new self(
            0,
            0,
            new DateTimeImmutable(),
            '',
            SenderInfoDto::createEmpty()
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
}
