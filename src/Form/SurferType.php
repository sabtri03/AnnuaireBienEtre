<?php

namespace App\Form;

use App\Entity\Surfer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SurferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('adresseNum')
            ->add('adresseStreet')
            ->add('banned')
            ->add('identifiant')
            ->add('inscrActivated')
            ->add('inscriDate')
            ->add('unsucessfulTry')
            ->add('userType')
            ->add('newsletter')
            ->add('name')
            ->add('surname')
            ->add('adresseCP')
            ->add('adresseLocality')
            ->add('adresseCity')
            ->add('profilProv')
            ->add('favorit')
            ->add('avatar')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Surfer::class,
        ]);
    }
}
