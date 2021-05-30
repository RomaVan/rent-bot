<?php

declare(strict_types=1);

return [
    'telegram' => [
        'key' => env('TELEGRAM_API_KEY', null),
        'webhookUrl' => env('TELEGRAM_WEBHOOK_URL', null)
    ]
];
