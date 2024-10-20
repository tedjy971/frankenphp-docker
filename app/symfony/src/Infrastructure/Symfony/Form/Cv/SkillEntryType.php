<?php

namespace Infrastructure\Symfony\Form\Cv;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SkillEntryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('name', TextType::class)
            ->add('level', ChoiceType::class, [
                'choices' => [
                    'Beginner' => 1,
                    'Intermediate' => 2,
                    'Advanced' => 3,
                ]
            ])
            ->add('keywords', TextType::class, ['required' => false])
            ->add('description', TextType::class, ['required' => false]);


    }
}
