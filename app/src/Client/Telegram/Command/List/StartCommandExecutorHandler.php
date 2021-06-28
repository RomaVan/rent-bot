<?php declare(strict_types=1);

namespace App\Client\Telegram\Command\List;

use App\Client\Telegram\Command\CommandExecutorInterface;
use App\Client\Telegram\Connector\TelegramClientInterface;
use App\Client\Telegram\Dto\RequestMessageDto;
use App\Client\Telegram\Dto\ResponseUpdateDto;
use App\Service\RegistrationService;

class StartCommandExecutorHandler implements CommandExecutorInterface
{
    public function __construct(
        private RegistrationService $registrationService,
        private TelegramClientInterface $telegramApiClient
    ) {}

    public function supportedCommand(): string
    {
        return '/start';
    }

    public function execute(string $command, ResponseUpdateDto $updateDto): void
    {
        $user = $this->registrationService->registerNew($updateDto);

        $this->telegramApiClient->sendMessage(
            RequestMessageDto::create($user->getId(), 'success')
        );
    }
}
