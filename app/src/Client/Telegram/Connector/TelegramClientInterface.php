<?php
declare(strict_types=1);

namespace App\Client\Telegram\Connector;

use App\Client\Telegram\Dto\RequestMessageDto;
use Psr\Http\Message\ResponseInterface;

interface TelegramClientInterface
{
    public function sendMessage(RequestMessageDto $message): ResponseInterface;
}
