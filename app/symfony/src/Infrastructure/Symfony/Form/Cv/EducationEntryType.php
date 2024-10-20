<?php

namespace Infrastructure\Symfony\Form\Cv;

use Infrastructure\Symfony\Form\User\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class EducationEntryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('institution', TextType::class)
            ->add('degree', TextType::class)
            ->add('yearStart', IntegerType::class)
            ->add('yearEnd', IntegerType::class, ['required' => false]);
    }
}
