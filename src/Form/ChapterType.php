<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Chapter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChapterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('name')
            ->add('text')
            ->add('book', EntityType::class, [
                'class'=>Book::class,
                'choice_label'=> 'name',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chapter::class,
            'translation_domain' => 'forms',
        ]);
    }
}
