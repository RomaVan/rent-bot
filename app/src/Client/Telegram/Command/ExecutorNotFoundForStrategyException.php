<?php
declare(strict_types=1);

namespace App\Client\Telegram\Command;

use Exception;

final class ExecutorNotFoundForStrategyException extends Exception
{
    public function __construct(string $text)
    {
        parent::__construct(sprintf('Not found executor for command with text [%s]', $text));
    }
}
