<?php
/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Bootloader;

use App\Client\Telegram\Command\CommandExecutorInterface;
use App\Client\Telegram\Command\CommandHandlerStrategy;
use App\Client\Telegram\Command\List\StartCommandExecutorHandler;
use App\Client\Telegram\TelegramApiClient;
use App\Service\RegistrationService;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Tokenizer\ClassesInterface;

class TelegramCommandsBootloader extends Bootloader
{
    protected const BINDINGS = [];

    protected const SINGLETONS = [];

    protected const DEPENDENCIES = [];

    public function boot(Container $container): void
    {
        $container->bind(CommandHandlerStrategy::class, function () use ($container) {
            return new CommandHandlerStrategy(// TODO: refactor
                new StartCommandExecutorHandler(
                    $container->get(RegistrationService::class),
                    $container->get(TelegramApiClient::class),
                )
            );
        });
    }
}
