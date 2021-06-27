<?php declare(strict_types=1);

namespace App\Client\Telegram;

use App\Config\ClientConfig;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use http\Exception\RuntimeException;

class TelegramApiClient
{
    private Client $client;

    public function __construct(
        public ClientConfig $clientConfig,
    ) {
        $this->client = $this->createClient();
    }

    public function setWebhook(): array
    {
        $webhookUrl = $this->clientConfig->getTelegram()['webhookUrl'] ?? throw new RuntimeException('set custom! not set url webhook');
        $response = $this->client->post(
            'setWebhook',
            $this->formatJsonStructure(['url' => $webhookUrl])
        );

        $content = $response->getBody()->getContents();

        return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
    }

    public function sendMessage(array $message): void
    {
        $this->client->post('sendMessage', $this->formatJsonStructure($message));
    }

    public function getWebhookInfo(): array
    {
        $response = $this->client->get('getWebhookInfo');

        $content = $response->getBody()->getContents();

        return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
    }

    public function deleteWebhook(): array
    {
        $response = $this->client->post('deleteWebhook');

        $content = $response->getBody()->getContents();

        return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
    }

    private function createClient(): Client
    {
        $token = $this->clientConfig->getTelegram()['key']; //TODO: move to value injection
        $baseUri = sprintf('https://api.telegram.org/bot%s/', $token);
        $client = new Client(
            [
                'base_uri' => $baseUri,
                'timeout' => 15.0,
            ]
        );

        return $client;
    }

    private function formatJsonStructure(array $data): array
    {
        return [
            RequestOptions::JSON => $data
        ];
    }
}
