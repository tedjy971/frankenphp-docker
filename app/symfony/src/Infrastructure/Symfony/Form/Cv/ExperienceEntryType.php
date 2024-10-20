<?php

namespace Infrastructure\Symfony\Form\Cv;

use Application\DTO\User\NoteCreateDTO;
use Application\DTO\User\UserDTO;
use Infrastructure\Symfony\Form\User\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ExperienceEntryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('company', TextType::class)
            ->add('position', TextType::class)
            ->add('startDate', DateType::class)
            ->add('endDate', DateType::class, ['required' => false])
            ->add('description', TextareaType::class);
    }
}
