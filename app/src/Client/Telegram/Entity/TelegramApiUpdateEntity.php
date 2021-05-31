<?php declare(strict_types=1);

namespace App\Client\Telegram\Entity;

use Cycle\Annotated\Annotation as Cycle;
use Cycle\Annotated\Annotation\Column;
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
    /** @Column(type = "json") */
    private $data;// TODO: create dto datatype

    private function __construct(array $data, DateTimeImmutable $createdAt)
    {
        $this->data = json_encode($data, JSON_THROW_ON_ERROR);
        $this->createdAt = $createdAt;
    }

    public static function createLog(array $data, ?DateTimeImmutable $createdAt = null): self
    {
        if ($createdAt === null) {
            $createdAt = new DateTimeImmutable();
        }

        return new self($data, $createdAt);
    }
}
