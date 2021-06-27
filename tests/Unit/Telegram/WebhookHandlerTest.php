<?php
declare(strict_types=1);

namespace Tests\Unit\Telegram;

use App\Client\Telegram\Command\CommandHandlerStrategy;
use App\Client\Telegram\WebhookHandler;
use Cycle\ORM\TransactionInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class WebhookHandlerTest extends TestCase
{
    private const MESSAGE = [
        'update_id' => 1,
        'message' => [
            'date' => 111,
            'text' => 'some',
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
    ];

    public function testHandleWithoutErrors(): void
    {
        /** @var CommandHandlerStrategy&Stub $commandStrategyStub */
        $commandStrategyStub = $this->createStub(CommandHandlerStrategy::class);
        /** @var TransactionInterface&MockObject $transactionMock */
        $transactionMock = $this->createMock(TransactionInterface::class);
        $transactionMock->expects($this->once())->method('persist');

        $handler = new WebhookHandler($commandStrategyStub);

        $handler->handle(self::MESSAGE, $transactionMock);
    }
}
