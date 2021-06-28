<?php declare(strict_types=1);

namespace App\Client\Telegram\Connector;

use App\Config\ClientConfig;
use GuzzleHttp\Client;

final class TelegramApiClientFactory
{
    public function __construct(
        private ClientConfig $clientConfig
    ) {}

    public function create(): Client
    {
        $token = $this->clientConfig->getTelegram()['key'];
        $baseUri = sprintf('https://api.telegram.org/bot%s/', $token);

        return new Client(
            [
                'base_uri' => $baseUri,
                'timeout' => 15.0,
            ]
        );
    }
}
