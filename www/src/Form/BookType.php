<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Serie;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File as FileFile;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du livre',
                'attr' => [
                    'placeholder' => 'Titre'
                ]
            ])
            ->add('numberPage', IntegerType::class, [
                'label' => 'Nombre de pages',
                'attr' => [
                    'placeholder' => 'Nombre de pages'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du livre',
                'attr' => [
                    'placeholder' => 'Description'
                ]
            ])
            ->add('releaseDate', DateTimeType::class, [
                'label' => 'Date de publication',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Prix',
                'attr' => [
                    'placeholder' => 'Prix'
                ]
            ])
            ->add('isbn', TextType::class, [
                'label' => 'ISBN',
                'attr' => [
                    'placeholder' => 'ISBN'
                ]
            ])
            ->add('serie', EntityType::class, [
                'class' => Serie::class,
                'choice_label' => 'title',
                'label' => 'Série',
                'attr' => [
                    'class' => 'form-control'
                ],
                'multiple' => false,
                'expanded' => true
            ])
        ;

        // Si on est en mode création, on ajoute le champ image et on le rend obligatoire
        if (!$options['is_edit']) {
            $builder
                ->add('imagePath', FileType::class, [
                    'label' => 'Couverture du livre',
                    'mapped' => false,
                    'required' => true,
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
                ]);
        }

        // Si on est en mode édition, pour ne pas avoir à recharger 
        // l'image à chaque fois si on ne veut pas la changer
        // Le champ imagePath n'est pas obligatoire et on ajoute un 
        // champ caché pour stocker le nom de l'image actuelle
        if ($options['is_edit']) {
            $builder->add('imagePath', FileType::class, [
                'label' => 'Couverture du livre',
                'mapped' => false,
                'required' => false,
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
            ->add('currentImage', HiddenType::class, [
                'mapped' => false
            ]);
        }

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
            'is_edit' => false // On ajoute une option pour savoir si on est en mode édition ou non
        ]);
    }
}
