<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Locality;
use App\Entity\PostalCode;
use App\Entity\Provider;
use App\Entity\Service;
use App\Form\ImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProviderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label'=> 'Email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            //->add('roles')
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
                    ]),
                ],
            ], array('label'=> 'Password','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('adresseNum', TextType::class, array('label'=> 'Adresse Number','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('adresseStreet', TextType::class, array('label'=> 'Adresse Street','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            //->add('banned', null, array('default' => 0))
            //->add('identifiant')
            //->add('inscrActivated')
            //->add('inscriDate', DateType::class, array('widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('placeholder' => 'yyyy-MM-dd',)))
            //->add('unsucessfulTry')
            //->add('userType')
            ->add('emailContact', EmailType::class, array('label'=> 'Email Contact','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('name', TextType::class, array('label'=> 'Name','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('phoneNumb', TextType::class, array('label'=> 'Phone Number','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('tvaNumb', IntegerType::class, array('label'=> 'TVA Number','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('website', UrlType::class, array('label'=> 'Website','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('adresseCP', EntityType::class, ['class'=>PostalCode::class,'choice_label'=>'postalCode'] , array('label'=> 'Code Postal','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('adresseLocality', EntityType::class, ['class'=>Locality::class,'choice_label'=>'locality'], array('label'=> 'Locality','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('adresseCity', EntityType::class, ['class'=>City::class,'choice_label'=>'city'], array('label'=> 'City','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('category',
                EntityType::class,
                [
                    'class' => Service::class,
                    'choice_label' => 'name',
                    'expanded'     => false,
                    'multiple'     => true,
                    'by_reference' => false,
                ], array('label'=> 'Category','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('logo',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'entry_options' => ['label' => false],
                    'allow_add' => true,
                    'by_reference'=>false,
                    'data_class' => null,
                ])
            // ->add('save', SubmitType::class, array('label' => 'Save'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Provider::class,

        ]);
    }
}
