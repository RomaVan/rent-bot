<?php
declare(strict_types=1);

namespace App\Bootloader;

use App\Client\Telegram\Command\CommandExecutorInterface;
use App\Client\Telegram\Command\CommandHandlerStrategy;
use App\Client\Telegram\Connector\SilentTelegramApiClient;
use App\Client\Telegram\Connector\TelegramApiClient;
use App\Client\Telegram\Connector\TelegramApiClientFactory;
use App\Client\Telegram\Connector\TelegramClientInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Tokenizer\ClassesInterface;

class TelegramBootloader extends Bootloader
{
    protected const BINDINGS = [
        TelegramClientInterface::class => SilentTelegramApiClient::class
    ];

    protected const SINGLETONS = [];

    protected const DEPENDENCIES = [];

    public function boot(Container $container, ClassesInterface $classes): void
    {
        if (env('ENV') === 'production') {
            /** @var TelegramApiClientFactory $clientFactory */
            $clientFactory = $container->get(TelegramApiClientFactory::class);
            $client = $clientFactory->create();
            $container->bind(TelegramClientInterface::class, fn () => new TelegramApiClient($client));
        }

        $objects = $this->getInstanceOfObjects($container, $classes, CommandExecutorInterface::class);
        $container->bind(CommandHandlerStrategy::class, function () use ($objects) {
            return new CommandHandlerStrategy(
                ...$objects
            );
        });
    }

    private function getInstanceOfObjects(Container $container, ClassesInterface $classes, string $target): array
    {
        $classesToInit = $classes->getClasses($target);

        $objects = [];
        foreach ($classesToInit as $class) {
            $objects[] = $container->get($class->getName());
        }

        return $objects;
    }
}
