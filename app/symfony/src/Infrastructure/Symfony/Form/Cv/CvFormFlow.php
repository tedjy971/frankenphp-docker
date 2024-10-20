<?php

namespace Infrastructure\Symfony\Form\Cv;

use Craue\FormFlowBundle\Form\FormFlow;

class CvFormFlow extends FormFlow {

    protected function loadStepsConfig(): array {
        return [
            [
                'label' => 'Personal Information',
                'form_type' => PersonalInfoType::class,
            ],
            [
                'label' => 'Education',
                'form_type' => EducationType::class,
            ],
            [
                'label' => 'Work Experience',
                'form_type' => ExperienceType::class,
            ],
            [
                'label' => 'Skills',
                'form_type' => SkillsType::class,
            ],
        ];
    }
}
