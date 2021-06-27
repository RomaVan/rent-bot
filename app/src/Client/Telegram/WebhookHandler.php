<?php declare(strict_types=1);

namespace App\Client\Telegram;

use App\Client\Telegram\Command\CommandHandlerStrategy;
use App\Client\Telegram\Dto\ResponseUpdateDto;
use App\Client\Telegram\Entity\TelegramApiUpdateEntity;
use Cycle\ORM\TransactionInterface;

class WebhookHandler
{
    public function __construct(
        private CommandHandlerStrategy $commandHandler
    ) {
    }

    public function handle(array $webhook, TransactionInterface $tr): void
    {
        $responseDto = ResponseUpdateDto::createFromResponse($webhook);

        $log = TelegramApiUpdateEntity::createLog($responseDto);

        $this->commandHandler->run($responseDto->getText(), $responseDto);

        $tr->persist($log);
    }
}
