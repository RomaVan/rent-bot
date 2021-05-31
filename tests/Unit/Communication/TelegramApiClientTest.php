<?php declare(strict_types=1);

namespace Tests\Unit\Communication;

use App\Client\Telegram\TelegramApiClient;
use App\Config\ClientConfig;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

// TODO: not unit test, uses for setup only now
class TelegramApiClientTest extends TestCase
{
    public function testConnect()
    {

        /** @var ClientConfig&MockObject $configMock */
        $configMock = $this->createMock(ClientConfig::class);
        $configMock->method('getTelegram')->willReturn([
           'key' => 'test',
           'webhookUrl' => 'https://ngrok.io/e2e3/webhook'
        ]);

        $client = new TelegramApiClient($configMock);
        $responseDelete = $client->deleteWebhook();
        $resSet= $client->setWebhook();
        $resInfo = $client->getWebhookInfo();


        $this->assertNotNull('d');
    }
}
