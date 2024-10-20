<?php

namespace Infrastructure\Symfony\Form\User;

use Application\DTO\User\NoteCreateDTO;
use Application\DTO\User\UserDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('email', TextType::class)
            ->add('plainPassword', PasswordType::class);
//            ->add('roles', ChoiceType::class, [
//                'choices' => [
//                    'ROLE_USER' => 'ROLE_USER',
//                    'ROLE_ADMIN' => 'ROLE_ADMIN',
//                ],
//                'multiple' => true,
//                'expanded' => true,
//            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => NoteCreateDTO::class,
        ]);
    }
}
