<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Title',
            ])
            ->add('overview', TextareaType::class, [
                'required'=> false,
            ])
            ->add('status', ChoiceType::class,[
                'choices'=> [
                    'cancelled'=>'Cancelled',
                    'ended'=>'Ended',
                    'returning'=>'Returning',
                ],
                'multiple'=>false,
            ])
            ->add('vote')
            ->add('popularity')
            ->add('genres')
           /* ->add('genres', ChoiceType::class,[
                'choices'=> [
                    'action'=>'Action',
                    'thriller'=>'Thriller',
                    'adventure'=>'Adventure',
                    'comedy'=>'Comedy',
                    'drama'=>'Drama',
                    'family'=>'Family',
                    'scifi'=>'Sci-Fi',
                    'crime'=>'Crime',
                    'mystery'=>'Mystery',
                    'western'=>'Western',
                    'kids'=>'Kids',
                    'war'=>'War',
                    'politics'=>'Politics',
                    'talk'=>'Talk',
                    'soap'=>'Soap',
                    'fantasy'=>'Fantasy',

                ],
                'multiple'=>true,
            ])*/
            ->add('firstAirDate', DateType::class, [
                'html5'=>true,
                'widget'=>'single_text',
            ])
            ->add('lastAirDate', DateType::class, [
                'html5'=>true,
                'widget'=>'single_text',
            ])
            ->add('backdrop')
            ->add('poster')
            ->add('tmdbId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
