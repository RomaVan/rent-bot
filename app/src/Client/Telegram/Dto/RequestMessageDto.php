<?php declare(strict_types=1);

namespace App\Client\Telegram\Dto;

final class RequestMessageDto
{
    private function __construct(
       private int $chatId,
       private string $text,
    ) {}

    public static function create(int $chatId, string $text): self
    {
        return new self($chatId, $text);
    }

    public function getChatId(): int
    {
        return $this->chatId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function toArray(): array
    {
        return [
            'chat_id' => $this->getChatId(),
            'text' => $this->getText()
        ];
    }
}
