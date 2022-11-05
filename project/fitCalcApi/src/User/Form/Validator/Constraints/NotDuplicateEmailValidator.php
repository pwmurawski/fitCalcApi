<?php

namespace App\User\Form\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use App\User\Repository\UserRepositoryInterface;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class NotDuplicateEmailValidator extends ConstraintValidator
{
    public UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $user = $this->userRepository->getByEmail($value);

        if (!$user) {
            return;
        }

        $this->context->buildViolation('User with this email already exist')->addViolation();
    }
}
