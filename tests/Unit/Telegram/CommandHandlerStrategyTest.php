<?php
declare(strict_types=1);

namespace Tests\Unit\Telegram;


use App\Client\Telegram\Command\CommandExecutorInterface;
use App\Client\Telegram\Command\CommandHandlerStrategy;
use App\Client\Telegram\Command\ExecutorNotFoundForStrategyException;
use App\Client\Telegram\Dto\ResponseUpdateDto;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class CommandHandlerStrategyTest extends TestCase
{
    public function testWillTakeCorrectExecutor(): void
    {
        /** @var CommandExecutorInterface&MockObject $strategyMock */
        $strategyMock = $this->createMock(CommandExecutorInterface::class);
        $strategyMock
            ->expects($this->once())
            ->method('supportedCommand')
            ->willReturn('test');

        /** @var CommandExecutorInterface&Stub $strategyStubIncorrect */
        $strategyStubIncorrect = $this->createStub(CommandExecutorInterface::class);
        $strategyStubIncorrect->method('supportedCommand')
            ->willReturn('not');

        $handler = new CommandHandlerStrategy($strategyStubIncorrect, $strategyMock);
        $handler->run('test', ResponseUpdateDto::createEmpty());
    }

    public function testWillStopOnFirstFoundExecutor(): void
    {
        /** @var CommandExecutorInterface&MockObject $strategyMock */
        $strategyMock = $this->createMock(CommandExecutorInterface::class);
        $strategyMock
            ->expects($this->once())
            ->method('supportedCommand')
            ->willReturn('test');

        /** @var CommandExecutorInterface&MockObject $strategyMockSecond */
        $strategyMockSecond = $this->createMock(CommandExecutorInterface::class);
        $strategyMockSecond
            ->expects($this->never())
            ->method('supportedCommand');

        $handler = new CommandHandlerStrategy($strategyMock, $strategyMockSecond);
        $handler->run('test', ResponseUpdateDto::createEmpty());
    }

    public function testWillThrowExceptionWhenNotChoose(): void
    {
        /** @var CommandExecutorInterface&Stub $strategyStubIncorrect */
        $strategyStubIncorrect = $this->createStub(CommandExecutorInterface::class);
        $strategyStubIncorrect->method('supportedCommand')
            ->willReturn('not');

        $this->expectException(ExecutorNotFoundForStrategyException::class);
        $this->expectExceptionMessage('Not found executor for command with text [test1]');

        $handler = new CommandHandlerStrategy($strategyStubIncorrect);
        $handler->run('test1', ResponseUpdateDto::createEmpty());
    }
}
