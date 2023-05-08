<?php

namespace App\Form;

use App\Entity\Building;
use App\Entity\Classroom;
use App\Entity\Infrastructure;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfrastructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('name')
//            ->add('description')
//            ->add('imagePath')
//            ->add('classrooms')





            ->add('name', TextType::class, [
                // 'label' => ['title',
                //             'class'=>'peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6'
                // ],
                'attr' => [
                    'autocomplete' => 'name',
                    'class' => 'block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer',
                    'placeholder' => 'eg. name'
                ],
            ])

            ->add('description', TextareaType::class, [
                // 'label' => ['title',
                //             'class'=>'peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6'
                // ],
                'attr' => [
                    'autocomplete' => 'description',
                    'class' => 'block py-2.5 my-5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer',
                    'placeholder' => 'eg.The description'
                ],
            ])
            ->add('imagePath',FileType::class, array('data_class' => null), [

                    // 'label' => ['upload image',
                    //             'class'=>'block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer'
                    // ],
                    'attr'=>array(
                        'class'=>'py-10 my-5',
                        'required'=>false,

                        'mapped'=>false

                    ),

                ]
            )

//            ->add('classrooms', EntityType::class, [
//
//                // looks for choices from this entity
//                'class' => Classroom::class,
//                // uses the User.username property as the visible option string
//                // 'choice_label' => 'name',
//                'multiple' => true,
//                'choice_label' => function ($classrooms) {
//                    return $classrooms->getName();
//                }
//                // used to render a select box, check boxes or radios
//                // 'multiple' => true,
//                // 'expanded' => true,
//
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Infrastructure::class,
        ]);
    }
}
