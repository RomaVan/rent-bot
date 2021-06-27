<?php declare(strict_types=1);

namespace App\Client\Telegram\Command;

use App\Client\Telegram\Dto\ResponseUpdateDto;

class CommandHandlerStrategy
{
    /** @var CommandExecutorInterface[] */
    private array $executors;

    public function __construct(CommandExecutorInterface ...$executors)
    {
        $this->executors = $executors;
    }

    /** @throws ExecutorNotFoundForStrategyException */
    public function run(string $command, ResponseUpdateDto $updateDto): void
    {
        foreach ($this->executors as $executor) {
            if ($executor->supportedCommand() === $command) {
                $executor->execute($command, $updateDto);
                return;
            }
        }

        throw new ExecutorNotFoundForStrategyException($command);
    }
}
