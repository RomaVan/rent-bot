<?php
declare(strict_types=1);

namespace App\Entity;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

/**
 * @Entity(repository="App\Repository\UserRepository")
 */
class User
{
    /** @Column(type = "integer(36)", primary = true) */
    private $id;
    /** @Column(type = "string") */
    private $firstName;
    /** @Column(type = "string") */
    private $lastName;

    private function __construct(int $id, string $name, string $lastname)
    {
        $this->id = $id;
        $this->firstName = $name;
        $this->lastName = $lastname;
    }

    public static function register(int $id, string $name, string $lastname): self
    {
        return new self($id, $name, $lastname);
    }

    public function getId(): int
    {
        return $this->id;
    }
}
