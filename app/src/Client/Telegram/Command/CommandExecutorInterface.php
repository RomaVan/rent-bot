<?php declare(strict_types=1);

namespace App\Client\Telegram\Command;

interface CommandExecutorInterface
{
    public function supportedCommand(): string;

    public function execute(string $command): void;
}
