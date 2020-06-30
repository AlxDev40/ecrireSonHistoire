<?php

namespace App\Form;

use App\Entity\Road;
use App\Entity\Chapter;
use App\Entity\Equipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\ChoiceList\Factory\Cache\PreferredChoice;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RoadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content')
            ->add('paragraph')
            ->add('chapter', EntityType::class, [
                'class' => Chapter::class,
                'choice_label' => function ($chapter) {
                    return $chapter->getName();
                }
            ])
            ->add('targetChapter', EntityType::class, [
                'class' => Chapter::class,
                'choice_label' => function ($chapter) {
                    return $chapter->getName();
                },
                'required' => false,

            ])
            ->add('necessary', EntityType::class, [
                'class' => Equipment::class,
                'choice_label' => function ($equipment) {
                    return $equipment->getName();
                },
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Road::class,
            'translation_domain' => 'forms'
        ]);
    }
}
