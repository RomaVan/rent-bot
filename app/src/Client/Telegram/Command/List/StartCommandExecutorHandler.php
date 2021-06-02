<?php declare(strict_types=1);

namespace App\Client\Telegram\Command\List;

use App\Client\Telegram\Command\CommandExecutorInterface;

class StartCommandExecutorHandler implements CommandExecutorInterface
{
    public function supportedCommand(): string
    {
        return '/start';
    }

    public function execute(string $command): void
    {
        // TODO: Implement execute() method.
    }
}
