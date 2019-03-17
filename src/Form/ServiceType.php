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
            ->add('description', TextType::class, array('label'=> 'Description','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('inFront', CheckboxType::class, [
                'label'    => 'In Front?',
                'required' => false,
            ], array('label'=> 'In Front','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('name', TextType::class, array('label'=> 'Name','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('validity', CheckboxType::class, [
                'label'    => 'Is it Valid?',
                'required' => false,
            ], array('label'=> 'Validity','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
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
