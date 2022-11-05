<?php

namespace App\SelectedProduct\Form\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use App\Meal\Repository\MealRepositoryInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class MealExistValidator extends ConstraintValidator
{
    public function __construct(private MealRepositoryInterface $mealRepository)
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

        $meal = $this->mealRepository->getById(new Uuid($value));

        if ($meal) {
            return;
        }

        $this->context->buildViolation('Meal not Exist')->addViolation();
    }
}
