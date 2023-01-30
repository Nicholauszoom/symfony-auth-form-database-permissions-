<?php

namespace App\Form;

use App\Entity\Movie;
// use Doctrine\DBAL\Types\IntegerType;
//use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class MovieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, [
                 'attr'=>array(
                'class'=>'bg-transparenct block border-b-2 w-full h-20 text-6xl outline-none',
                'placeholder'=> 'Enter Title..'
                 ),
                 'label'=>false,
                 'required'=>false
            ]
            )
            ->add('releaseyYear',IntegerType::class, [
                'attr'=>array(
               'class'=>'bg-transparenct block mt-10 border-b-2 w-full h-20 text-6xl outline-none',
               'placeholder'=> 'Enter Office no..'
                ),
                'label'=>false,
                'required'=>false

           ]
           )
            ->add('description',TextareaType::class, [
                'attr'=>array(
               'class'=>'bg-transparenct block mt-10 border-b-2 w-full h-60 text-6xl outline-none',
               'placeholder'=> 'Enter Description..'
                ),
                'label'=>false,
                'required'=>false

           ]
           )


        //    ->add('imagePath', FileType::class,array(
        //     'required'=>false,
        //     'mapped'=>false
        //    ))
            ->add('imagePath',FileType::class, [
                'attr'=>array(
               'class'=>'py-10',
               'required'=>false,
                'mapped'=>false
              
                ),
              
           ]
           )
            // ->add('actors')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
