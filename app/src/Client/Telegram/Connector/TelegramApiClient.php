<?php declare(strict_types=1);

namespace App\Client\Telegram\Connector;

use App\Client\Telegram\Dto\RequestMessageDto;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

final class TelegramApiClient implements TelegramClientInterface
{
    public function __construct(
        private Client $client,
    ) {}

    public function sendMessage(RequestMessageDto $message): ResponseInterface
    {
        return $this->client->post('sendMessage', $this->formatJsonStructure($message->toArray()));
    }

    private function formatJsonStructure(array $data): array
    {
        return [
            RequestOptions::JSON => $data
        ];
    }
}
