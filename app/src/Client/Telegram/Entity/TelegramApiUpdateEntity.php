<?php declare(strict_types=1);

namespace App\Client\Telegram\Entity;

use App\Client\Telegram\Dto\ResponseUpdateDto;
use App\Client\Telegram\Dto\SenderInfoDto;
use Cycle\Annotated\Annotation as Cycle;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Relation\Embedded;
use DateTimeImmutable;

/**
 * @Cycle\Entity()
 */
class TelegramApiUpdateEntity
{
    /** @Column(type = "primary") */
    private $id;
    /** @Column(type = "datetime") */
    private DateTimeImmutable $createdAt;
    /** @Embedded(target = "App\Client\Telegram\Dto\ResponseUpdateDto") */
    private ResponseUpdateDto $data;
    /** @Embedded(target = "App\Client\Telegram\Dto\SenderInfoDto") */
    private SenderInfoDto $sender;

    private function __construct(
        ?ResponseUpdateDto $data,
        ?SenderInfoDto $sender,
        DateTimeImmutable $createdAt
    ) {
        $this->createdAt = $createdAt;
        $this->data = $data ?? ResponseUpdateDto::createEmpty();
        $this->sender = $sender ?? SenderInfoDto::createEmpty();
    }

    public static function createLog(
        ResponseUpdateDto $data,
        ?DateTimeImmutable $createdAt = null
    ): self {
        if ($createdAt === null) {
            $createdAt = new DateTimeImmutable();
        }

        $sender = $data?->getFrom();

        return new self($data, $sender, $createdAt);
    }
}
