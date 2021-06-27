<?php declare(strict_types=1);

namespace App\Controller;

use App\Client\Telegram\WebhookHandler;
use Cycle\ORM\TransactionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class ApiController
{
    use PrototypeTrait;

    public function __construct(
        private WebhookHandler $webhookHandler,
        private TransactionInterface $transaction,
        private LoggerInterface $logger
    ) {}

    /**
     * TODO: dynamic route webhook id
     * @Route(route="/e2e3/webhook", name="webhook", methods="post")
     */
    public function webhook(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        $this->webhookHandler->handle($body, $this->transaction);

        try {
            $this->transaction->run();
        } catch (\Error $error) {
            $this->logger->error('Cannot handle telegram request', $error->getTrace());
        }

        return $this->response->json(['ok' => true]);
    }
}
