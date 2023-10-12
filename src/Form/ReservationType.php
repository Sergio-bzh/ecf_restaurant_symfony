<?php

namespace App\Form;

use App\Entity\Allergie;
use App\Entity\Reservation;
use App\Entity\User;
use Cassandra\Type\UserType;
use Doctrine\ORM\Query\Expr\Select;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('client_name', TextType::class, [
              'attr' => [
                  'class' => 'form-control mb-3',
              ],
              'label' => 'Nom :',
              'required' => true
            ])

            ->add('phone_umber', TelType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Téléphone :',
                'required' => true
            ])

            ->add('guest_number', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Nombre de convives :',
                'required' => true
            ])

            ->add('reservation_date', DateType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Date de réservation :',
                'required' => true
            ])

            ->add('meal_time', TimeType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Heure :',
                'required' => true
            ])

            ->add('allergie', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check mb-3'
                ],
                'label' => 'Allergie :',
                'required' => true
            ])
/*
            ->add('restaurant', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control mb-3 d-none'
                ],
                'label' => 'Restaurant :',
                'required' => true
            ])

// ATTENTION !
// Penser à afficher le champs une fois l'utilisateur connecté

            ->add('user', EntityType::class, [
                'class' => User::class,
                'attr' => [
                    'class' => 'form-select mb-3'
                ],
                'label' => 'Nom d\'utilisateur :',
                'required' => true
            ])
*/

            ->add('allergies', EntityType::class, [
                'class' => Allergie::class,
                'attr' => [
                    'class' => 'form-select mb-3'
                ],
                'label' => 'Allergie :',
                'required' => true
            ])

            //->add('client_name')
            //->add('phone_number')
            //->add('guest_number')
            //->add('reservation_date')
            //->add('meal_time')
            //->add('allergie')
            //->add('restaurant')
            //->add('user')
            //->add('allergies')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
