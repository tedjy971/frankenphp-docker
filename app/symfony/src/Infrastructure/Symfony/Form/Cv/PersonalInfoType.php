<?php

namespace Infrastructure\Symfony\Form\Cv;

use Domain\Repository\UserRepositoryInterface;
use Infrastructure\Symfony\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonalInfoType extends AbstractType {

    public function __construct(private UserRepositoryInterface $userRepository) {

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $users = $this->userRepository->findAll();

        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,  // Spécifie l'entité User
                'choice_label' => 'firstname',  // Ce champ sera affiché comme label (fullName est un exemple, tu peux le remplacer par un autre champ de l'entité User)
                'placeholder' => 'Sélectionnez un utilisateur',  // Optionnel : pour avoir une option par défaut vide
                'choices' => $users,  // Les choix sont les utilisateurs récupérés
                'mapped' => false,
            ]);
    }

    public function getBlockPrefix(): string {
        return 'createVehicleStep1';
    }
}
