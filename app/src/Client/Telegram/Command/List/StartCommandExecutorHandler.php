<?php declare(strict_types=1);

namespace App\Client\Telegram\Command\List;

use App\Client\Telegram\Command\CommandExecutorInterface;
use App\Client\Telegram\Dto\ResponseUpdateDto;
use App\Client\Telegram\TelegramApiClient;
use App\Service\RegistrationService;

class StartCommandExecutorHandler implements CommandExecutorInterface
{
    public function __construct(
        private RegistrationService $registrationService,
        private TelegramApiClient $telegramApiClient
    ) {}

    public function supportedCommand(): string
    {
        return '/start';
    }

    public function execute(string $command, ResponseUpdateDto $updateDto): void
    {
        $user = $this->registrationService->registerNew($updateDto);

        $this->telegramApiClient->sendMessage(
            [
                'chat_id' => $user->getId(),
                'text' => 'success'
            ]
        );
    }
}
