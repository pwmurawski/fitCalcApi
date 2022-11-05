<?php

declare(strict_types=1);

namespace App\User\Factory;

use App\User\Entity\User;
use Symfony\Component\Uid\Uuid;

interface UserFactoryInterface
{
    public function create(Uuid $id, string $email, string $password): User;
}
