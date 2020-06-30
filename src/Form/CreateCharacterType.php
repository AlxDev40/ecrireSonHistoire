<?php

namespace App\Form;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('characterName')
            ->add(
                'class',
                ChoiceType::class,
                [
                    'placeholder' => 'Quelle classe voulez-vous jouer? ',
                    'choices' => [
                        'Guerrier' => 'Guerrier',
                        'Magicien' => 'Magicien',
                    ]
                ]
            )
            ->add(
                'gender',
                ChoiceType::class,
                [
                    'placeholder' => 'Quel est votre genre? ',
                    'choices' => [
                        'Homme' => 'homme',
                        'Femme' => 'femme',
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
