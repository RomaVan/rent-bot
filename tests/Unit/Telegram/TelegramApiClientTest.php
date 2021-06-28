<?php declare(strict_types=1);

namespace Tests\Unit\Telegram;

use App\Client\Telegram\Connector\TelegramApiClient;
use App\Client\Telegram\Dto\RequestMessageDto;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class TelegramApiClientTest extends TestCase
{
    public function testSendMessage(): void
    {
        $mock = new MockHandler(
            [
                new Response(200, [], 'test'),
            ]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $tgClient = new TelegramApiClient($client);

        $response = $tgClient->sendMessage(RequestMessageDto::create(123, 'test'));

        $this->assertSame(200, $response->getStatusCode());
    }
}
