<?php

namespace Infrastructure\Symfony\Form\User;

use Application\DTO\User\NoteCreateDTO;
use Application\DTO\User\UserDTO;
use Application\DTO\User\NoteUpdateDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateUserType extends UserType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('firstName', TextType::class)
            ->add('email', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => NoteUpdateDTO::class,
        ]);
    }
}
