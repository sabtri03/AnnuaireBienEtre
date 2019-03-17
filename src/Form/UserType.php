<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Locality;
use App\Entity\PostalCode;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label'=> 'Email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('password', PasswordType::class, [
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ])
                ]
            ], array('label'=> 'Password','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('adresseNum', TextType::class, array('label'=> 'Adresse Number','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('adresseStreet', TextType::class, array('label'=> 'Adresse Street','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('adresseCP', EntityType::class, ['class'=>PostalCode::class,'choice_label'=>'postalCode'] , array('label'=> 'Code Postal','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('adresseLocality', EntityType::class, ['class'=>Locality::class,'choice_label'=>'locality'], array('label'=> 'Locality','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('adresseCity', EntityType::class, ['class'=>City::class,'choice_label'=>'city'], array('label'=> 'City','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
