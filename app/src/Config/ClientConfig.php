<?php
/**
 * {project-name}
 * 
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Config;

use Spiral\Core\InjectableConfig;

class ClientConfig extends InjectableConfig
{
    public const CONFIG = 'client';

    /**
     * @internal For internal usage. Will be hydrated in the constructor.
     */
    protected $config = [
        'telegram' => []
    ];

    /**
     * @return array|string[]
     */
    public function getTelegram(): array
    {
        return $this->config['telegram'];
    }
}
