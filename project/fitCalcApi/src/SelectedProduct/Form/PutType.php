<?php

declare(strict_types=1);

namespace App\SelectedProduct\Form;

use Symfony\Component\Uid\Uuid;
use App\SelectedProduct\DTO\PutSelectedProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Range;

class PutType extends AbstractType implements DataTransformerInterface
{
    private ?Uuid $id;
    private ?Uuid $userId;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->id = $options['id'];
        $this->userId = $options['userId'];

        $builder->add(
            'weight',
            NumberType::class,
            [
                'constraints' => [
                    new NotBlank(),
                    new Range(
                        [
                            'min' => 0,
                            'max' => PHP_INT_MAX
                        ]
                    ),
                ]
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

    public function reverseTransform($value): ?PutSelectedProduct
    {
        if (
            null === $value['weight']
        ) {
            return null;
        }

        if (array_key_exists('weight', $value)) {
            return new PutSelectedProduct(
                $this->id,
                $this->userId,
                $value['weight'],
            );
        }
    }
}
