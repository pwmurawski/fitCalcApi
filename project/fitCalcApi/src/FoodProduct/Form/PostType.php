<?php

declare(strict_types=1);

namespace App\FoodProduct\Form;

use Symfony\Component\Uid\Uuid;
use App\FoodProduct\DTO\FoodProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class PostType extends AbstractType implements DataTransformerInterface
{
    private ?Uuid $foodProductId;
    private ?Uuid $userId;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->foodProductId = $options['foodProductId'];
        $this->userId = $options['userId'];

        $builder->add(
            'name',
            TextType::class,
            [
                'constraints' => [
                    new Length(['max' => 255]),
                    new NotBlank(),
                ]
            ]
        );

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

        $builder->add(
            'code',
            TextType::class,
            [
                'constraints' => [
                    new Length(['max' => 255]),
                ]
            ]
        );

        $builder->addModelTransformer($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('foodProductId', null);
        $resolver->setDefault('userId', null);
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }


    public function transform($value): ?array
    {
        return $value;
    }

    public function reverseTransform($value): ?FoodProduct
    {
        if (
            null === $value['name'] ||
            null === $value['kcal'] ||
            null === $value['protein'] ||
            null === $value['fat'] ||
            null === $value['carbs']
        ) {
            return null;
        }

        return new FoodProduct(
            $this->foodProductId,
            $this->userId,
            $value['name'],
            $value['kcal'],
            $value['protein'],
            $value['fat'],
            $value['carbs'],
            $value['code']
        );
    }
}
