<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Editor;
use App\Entity\Serie;
use App\Entity\Type;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('number_volume')
            ->add('dateStarted', null, [
                'widget' => 'single_text',
            ])
            ->add('isFinished')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('editors', EntityType::class, [
                'class' => Editor::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('types', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
