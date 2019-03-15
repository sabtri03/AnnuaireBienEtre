<?php

namespace App\Form;

use App\Entity\Service;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextType::class)
            ->add('inFront', CheckboxType::class, [
                'label'    => 'In Front?',
                'required' => false,
            ])
            ->add('name', TextType::class)
            ->add('validity', CheckboxType::class, [
                'label'    => 'Is it Valid?',
                'required' => false,
            ])
            //->add('Propose')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
