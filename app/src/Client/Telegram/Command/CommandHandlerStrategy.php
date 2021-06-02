<?php declare(strict_types=1);

namespace App\Client\Telegram\Command;

class CommandHandlerStrategy
{
    /** @var CommandExecutorInterface[] */
    private array $executors;

    public function __construct(CommandExecutorInterface ...$executors)
    {
        $this->executors = $executors;
    }

    public function run(string $command): void
    {
        foreach ($this->executors as $executor) {
            if ($executor->supportedCommand() === $command) {
                $executor->execute($command);
                break;
            }

            throw new \RuntimeException('invalid command');// TODO: add custom
        }
    }
}
