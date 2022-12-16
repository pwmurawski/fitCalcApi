<?php

declare(strict_types=1);

namespace App\DailyGoals\Form;

use Symfony\Component\Uid\Uuid;
use App\DailyGoals\DTO\DailyGoals;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class PostType extends AbstractType implements DataTransformerInterface
{
    private ?Uuid $dailyGoalsId;
    private ?Uuid $userId;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->dailyGoalsId = $options['dailyGoalsId'];
        $this->userId = $options['userId'];

        $builder->add(
            'kcal',
            NumberType::class,
            [
                'constraints' => [
                    new NotBlank(),
                ]
            ]
        );

        $builder->add(
            'protein',
            NumberType::class,
            [
                'constraints' => [
                    new NotBlank(),
                ]
            ]
        );

        $builder->add(
            'fat',
            NumberType::class,
            [
                'constraints' => [
                    new NotBlank(),
                ]
            ]
        );

        $builder->add(
            'carbs',
            NumberType::class,
            [
                'constraints' => [
                    new NotBlank(),
                ]
            ]
        );

        $builder->addModelTransformer($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('dailyGoalsId', null);
        $resolver->setDefault('userId', null);
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }


    public function transform($value): ?array
    {
        return $value;
    }

    public function reverseTransform($value): ?DailyGoals
    {
        if (
            null === $value['kcal'] ||
            null === $value['protein'] ||
            null === $value['fat'] ||
            null === $value['carbs']

        ) {
            return null;
        }

        return new DailyGoals(
            $this->dailyGoalsId,
            $this->userId,
            $value['kcal'],
            $value['protein'],
            $value['fat'],
            $value['carbs'],
        );
    }
}
