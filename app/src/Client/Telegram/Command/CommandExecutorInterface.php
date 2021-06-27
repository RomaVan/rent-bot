<?php declare(strict_types=1);

namespace App\Client\Telegram\Command;

use App\Client\Telegram\Dto\ResponseUpdateDto;

interface CommandExecutorInterface
{
    public function supportedCommand(): string;

    public function execute(string $command, ResponseUpdateDto $updateDto): void;
}
