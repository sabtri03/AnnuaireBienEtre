<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Localite;
use App\Entity\Locality;
use App\Entity\PostalCode;
use App\Entity\Surfer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SurferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)
            //->add('roles')
            ->add('password',PasswordType::class, [
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
            ])
            ->add('adresseNum',IntegerType::class)
            ->add('adresseStreet',TextType::class)
            //->add('banned')
            //->add('identifiant')
            //->add('inscrActivated')
            //->add('inscriDate')
            //->add('unsucessfulTry')
            //->add('userType')
            ->add('newsletter', CheckboxType::class, [
                'label'    => 'Ok Newsletter?',
                'required' => false,
            ])
            ->add('name',TextType::class)
            ->add('surname', TextType::class)
            ->add('adresseCP',  EntityType::class, ['class'=>PostalCode::class,'choice_label'=>'postalCode'])
            ->add('adresseLocality', EntityType::class, ['class'=>Locality::class,'choice_label'=>'locality'])
            ->add('adresseCity', EntityType::class, ['class'=>City::class,'choice_label'=>'city'])
            //->add('favorit')
            //->add('avatar',CollectionType::class,['entry_type' => ImageType::class,'entry_options' => ['label' => false],'allow_add' => true,'by_reference'=>false,'data_class' => null,])
            //->add('save', SubmitType::class, array('label' => 'Save'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Surfer::class,
        ]);
    }
}
