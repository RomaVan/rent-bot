<?php declare(strict_types=1);

namespace App\Service;

use App\Client\Telegram\Dto\ResponseUpdateDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Cycle\ORM\TransactionInterface;

class RegistrationService
{
    public function __construct(
        private UserRepository $users,
        private TransactionInterface $transaction
    ) {}

    public function registerNew(ResponseUpdateDto $updateDto): User
    {
        $fromDto = $updateDto->getFrom();

        $user = $this->users->findByPK($fromDto->getSenderId());

        if ($user === null) {
            $user = User::register(
                $fromDto->getSenderId(),
                $fromDto->getFirstName(),
                $fromDto->getLastName(),
            );

            $this->transaction->persist($user);
        }

        $this->transaction->run();

        return $user;
    }
}
