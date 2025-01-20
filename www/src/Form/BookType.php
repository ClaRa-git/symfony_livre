<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Serie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('numberPage')
            ->add('description')
            ->add('releaseDate', null, [
                'widget' => 'single_text',
            ])
            ->add('imagePath')
            ->add('price')
            ->add('isbn')
            ->add('serie', EntityType::class, [
                'class' => Serie::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
