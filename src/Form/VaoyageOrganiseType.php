<?php

namespace App\Form;

use App\Entity\VaoyageOrganise;
use App\Entity\Ville;
use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class VaoyageOrganiseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('images', CollectionType::class, array(
                'entry_type' => ImageType::class,
                'by_reference' => false,
                'allow_add' => true,
                'prototype' => true,
                'allow_delete' => true,
            ))
            ->add('DateDepart')
            ->add('NbreJour')
            ->add('Prix')
            ->add('Title')
            ->add('Cover', FileType::class, array(
                "data_class" => null,
                "required" => false
            ))
            ->add('Programme')
            ->add('villes', EntityType::class, array(

                'class' => Ville::class,
                'choice_label' => 'Nom',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VaoyageOrganise::class,
        ]);
    }
}
