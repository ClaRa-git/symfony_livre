<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Editor;
use App\Entity\Serie;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('imagePath', FileType::class, [
                'label' => 'Image de la série',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                            'image/gif',
                            'image/webp'
                        ],
                        'mimeTypesMessage' => 'Merci de choisir un format d\'image valide (jpeg, jpg, png, gif, webp)',
                    ])
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('number_volume', IntegerType::class, [
                'label' => 'Nombre de volumes',
                'attr' => [
                    'placeholder' => 'Nombre de volumes'
                ]
            ])
            ->add('isFinished', ChoiceType::class, [
                'label' => 'Série terminée ?',
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'expanded' => false,
                'multiple' => false,
                'attr' => [
                    'class' => 'form-control'
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
            ->add('editors', EntityType::class, [
                'class' => Editor::class,
                'label' => 'Editeur(s)',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('types', EntityType::class, [
                'class' => Type::class,
                'label' => 'Type(s)',
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('authors', EntityType::class, [
                'class' => Author::class,
                'label' => 'Auteur(s)',
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
