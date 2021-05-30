<?php

declare(strict_types=1);

namespace App\Controller;

use App\Clients\Telegram\Client\TelegramApiClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class ApiController
{
    use PrototypeTrait;

    public function __construct(
        private TelegramApiClient $telegramApiClient
    ) {}

    /**
     * TODO: dynamic route webhook id
     * @Route(route="/e2e3/webhook", name="webhook", methods="post")
     */
    public function webhook(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        $info = $this->telegramApiClient->getWebhookInfo();
        // TODO: parse and handle
        $a = $info;
        return $this->response->json(
            [
                'ok' => true
            ],
            200
        );
    }
}
