<?php

namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Date',DateType::class, array(
                'widget' => 'single_text',
            ))
            ->add('NbrePlace')
            ->add('Prix')
           # ->add('DateCreation')
           # ->add('VaoyageOrganise')
            #->add('Soire')
           ->add('user', EntityType::class, array(

               'class' => User::class,
               'choice_label' => 'Nom',
           ))
           ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
