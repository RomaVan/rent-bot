<?php declare(strict_types=1);

namespace App\Client\Telegram;

use App\Client\Telegram\Dto\ResponseUpdateDto;
use App\Client\Telegram\Entity\TelegramApiUpdateEntity;
use Cycle\ORM\TransactionInterface;

class WebhookHandler
{
    public function handle(array $webhook, TransactionInterface $tr): void
    {
        $responseDto = ResponseUpdateDto::createFromResponse($webhook);

        $log = TelegramApiUpdateEntity::createLog($responseDto);

        // todo add here command handler strategy

        $tr->persist($log);
    }
}
