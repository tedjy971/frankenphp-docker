<?php

namespace Infrastructure\Symfony\Form\Cv;

use Application\DTO\User\NoteCreateDTO;
use Application\DTO\User\UserDTO;
use Infrastructure\Symfony\Form\User\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder->add('experiences', CollectionType::class, [
            'entry_type' => ExperienceEntryType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
        ]);
    }
}
