<?php
declare(strict_types=1);

namespace Tests\Feature\Telegram;

use Tests\TestCase;

class TelegramWebhookApiTest extends TestCase
{
    public function testPostWebhookMessageSmoke(): void
    {
        $response = $this->post('/e2e3/webhook', [
            'update_id' => 1,
            'message' => [
                'date' => 111,
                'text' => '/start',
                'from' => [
                    'id' => 1,
                    'is_bot' => false,
                    'first_name' => 'a',
                    'last_name' => 'b',
                    'language_code' => 'en',
                    'username' => 'test',
                ],
                'message_id' => 1,
            ]
        ]);

        $this->assertSame($response->getStatusCode(), 200);
    }
}
