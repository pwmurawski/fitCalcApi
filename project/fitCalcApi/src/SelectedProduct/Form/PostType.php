<?php

declare(strict_types=1);

namespace App\SelectedProduct\Form;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Form\FormBuilderInterface;
use App\SelectedProduct\DTO\SelectedProduct;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use App\SelectedProduct\Form\Validator\Constraints\MealExist;
use App\SelectedProduct\Form\Validator\Constraints\FoodProductExist;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PostType extends AbstractType implements DataTransformerInterface
{
    private ?Uuid $id;
    private ?Uuid $userId;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->id = $options['id'];
        $this->userId = $options['userId'];

        $builder->add(
            'mealId',
            TextType::class,
            [
                'constraints' => [
                    new Constraints\Uuid(),
                    new NotBlank(),
                    new MealExist(),
                ]
            ]
        );

        $builder->add(
            'foodProductId',
            TextType::class,
            [
                'constraints' => [
                    new Constraints\Uuid(),
                    new NotBlank(),
                    new FoodProductExist(),
                ]
            ]
        );

        $builder->add(
            'weight',
            NumberType::class,
            [
                'constraints' => [
                    new NotBlank(),
                ]
            ]
        );

        $builder->add(
            'dateTime',
            TextType::class,
            [
                'constraints' => [
                    new NotBlank()
                ],
            ]
        );

        $builder->addModelTransformer($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('id', null);
        $resolver->setDefault('userId', null);
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }


    public function transform($value): ?array
    {
        return $value;
    }

    public function reverseTransform($value): ?SelectedProduct
    {
        if (
            null === $value['mealId'] ||
            null === $value['foodProductId'] ||
            null === $value['weight'] ||
            null === $value['dateTime']
        ) {
            return null;
        }

        return new SelectedProduct(
            $this->id,
            $this->userId,
            $value['mealId'],
            $value['foodProductId'],
            $value['weight'],
            $value['dateTime'],
        );
    }
}
