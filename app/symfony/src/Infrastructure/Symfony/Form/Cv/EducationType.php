<?php

namespace Infrastructure\Symfony\Form\Cv;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class EducationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder->add('educations', CollectionType::class, [
            'entry_type' => EducationEntryType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => true,
            'entry_options' => ['label' => false],

        ]);
    }

}
