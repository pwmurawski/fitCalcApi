<?php

namespace App\SelectedProduct\Form\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use App\FoodProduct\Repository\FoodProductRepositoryInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class FoodProductExistValidator extends ConstraintValidator
{
    public function __construct(private FoodProductRepositoryInterface $foodProductRepository)
    {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $foodProduct = $this->foodProductRepository->getById(new Uuid($value));

        if ($foodProduct) {
            return;
        }

        $this->context->buildViolation('FoodProduct not Exist')->addViolation();
    }
}
