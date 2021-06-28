<?php
declare(strict_types=1);

namespace App\Client\Telegram\Connector;

use App\Client\Telegram\Dto\RequestMessageDto;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Uses for dev purposes to avoid making real api call
 */
class SilentTelegramApiClient implements TelegramClientInterface
{
    public function sendMessage(RequestMessageDto $message): ResponseInterface
    {
        return new Response();
    }
}
