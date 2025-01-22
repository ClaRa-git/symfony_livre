<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Editor;
use App\Entity\Serie;
use App\Entity\Type;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de la série',
                'attr' => [
                    'placeholder' => 'Titre'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de la série',
                'attr' => [
                    'placeholder' => 'Description'
                ]
            ])
            ->add('number_volume', IntegerType::class, [
                'label' => 'Nombre de volumes',
                'attr' => [
                    'placeholder' => 'Nombre de volumes'
                ]
            ])
            ->add('dateStarted', DateTimeType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Date de début',
                    'class' => 'form-control'
                ]
            ])
            ->add('isFinished', CheckboxType::class, [
                'label_attr' => ['class' => 'switch-custom'],
                'label' => 'Terminée',
                'required' => false,
            ])
            ->add('editors', EntityType::class, [
                'class' => Editor::class,
                'choice_label' => 'name',
                'label' => 'Editeur',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('types', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'label' => 'Auteur',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
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
