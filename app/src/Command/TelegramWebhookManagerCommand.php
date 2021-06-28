<?php declare(strict_types=1);

namespace App\Command;

use App\Client\Telegram\Connector\TelegramApiClientFactory;
use App\Config\ClientConfig;
use GuzzleHttp\RequestOptions;
use Spiral\Console\Command;

class TelegramWebhookManagerCommand extends Command
{
    protected const NAME = 'telegram:webhook';

    protected const DESCRIPTION = 'Manages telegram webhook';

    protected const ARGUMENTS = [];

    protected const OPTIONS = [];

    /**
     * Perform command
     */
    protected function perform(ClientConfig $clientConfig, TelegramApiClientFactory $apiClientFactory): void
    {
        $webhookUrl = $clientConfig->getTelegram()['webhookUrl'];
        $client = $apiClientFactory->create();
        $response = $client->post(
            'setWebhook',
            [
                RequestOptions::JSON => ['url' => $webhookUrl]
            ]
        );

        $content = $response->getBody()->getContents();

        $data =  json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        $this->writeln($data);
    }
}
