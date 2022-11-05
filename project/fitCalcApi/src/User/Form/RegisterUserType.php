<?php

declare(strict_types=1);

namespace App\User\Form;

use App\User\DTO\CreateUser;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use App\User\Form\Validator\Constraints\NotDuplicateEmail;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterUserType extends AbstractType implements DataTransformerInterface
{
    private ?Uuid $userId;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->userId = $options['userId'];

        $builder->add(
            'email',
            EmailType::class,
            [
                'constraints' => [
                    new Length(['max' => 255]),
                    new Email(),
                    new NotBlank(),
                    new NotDuplicateEmail(),
                ]
            ]
        );

        $builder->add(
            'password',
            PasswordType::class,
            [
                'constraints' => [
                    new Length(['max' => 255, 'min' => 5]),
                    new NotBlank(),
                ]
            ]
        );

        $builder->addModelTransformer($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('userId', null);
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }


    public function transform($value): ?array
    {
        return $value;
    }

    public function reverseTransform($value): ?CreateUser
    {
        if (
            null === $value['email'] ||
            null === $value['password']
        ) {
            return null;
        }

        return new CreateUser($this->userId, $value['email'], $value['password']);
    }
}
