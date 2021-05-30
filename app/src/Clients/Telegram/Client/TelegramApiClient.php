<?php

namespace App\Clients\Telegram\Client;

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

    public function getBotInfo()
    {

        $res = $this->client->get('getMe');
        $body = $res->getBody()->getContents();

        return $body;
    }

    public function setWebhook(): array
    {
        $webhookUrl = $this->clientConfig->getTelegram()['webhookUrl'] ?? throw new RuntimeException('set custom! not set url webhook');
        $response = $this->client->post('setWebhook', [
            RequestOptions::JSON => ['url' => $webhookUrl]
        ]);

        $content = $response->getBody()->getContents();

        return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
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
//        $token = $this->clientConfig->getTelegram()['key']; //TODO: move to value injection
        $token ='1736513094:AAFomYBMPpbPn5j9UmKLuHI5K7MB8RN1sA4';
        $baseUri = sprintf('https://api.telegram.org/bot%s/', $token);
        $client = new Client(
            [
                'base_uri' => $baseUri,
                'timeout' => 2.0,
            ]
        );

        return $client;

    }
}
