<?php

declare(strict_types=1);

namespace App\User\UseCase;

use App\User\DTO\CreateUser;
use App\User\Factory\UserFactoryInterface;
use App\User\Repository\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserUseCase
{
    public function __construct(
        private UserFactoryInterface $userFactory,
        private UserRepositoryInterface $userRepository,
        private UserPasswordHasherInterface $hasher
    ) {
    }

    public function execute(CreateUser $userData): void
    {
        $user = $this->userFactory->create($userData->getId(), $userData->getEmail(), $userData->getPassword());
        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                $user->getPassword(),
            )
        );

        $this->userRepository->save($user);
    }
}
