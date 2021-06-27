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

    public function run(string $command, ResponseUpdateDto $updateDto): void
    {
        foreach ($this->executors as $executor) {
            if ($executor->supportedCommand() === $command) {
                $executor->execute($command, $updateDto);
                break;
            }

            throw new \RuntimeException('invalid command');// TODO: add custom
        }
    }
}
