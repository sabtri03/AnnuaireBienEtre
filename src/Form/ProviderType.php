<?php

namespace App\Form;

use App\Entity\Provider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderType extends AbstractType
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
            ->add('emailContact')
            ->add('name')
            ->add('phoneNumb')
            ->add('tvaNumb')
            ->add('website')
            ->add('adresseCP')
            ->add('adresseLocality')
            ->add('adresseCity')
            ->add('profilProv')
            ->add('profil')
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Provider::class,
        ]);
    }
}
