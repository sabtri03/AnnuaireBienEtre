<?php

namespace App\Form;

use App\Entity\Internship;
use App\Entity\Provider;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternshipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('showDate', DateType::class, array('label'=> 'Show Date','widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('placeholder' => 'yyyy-MM-dd','class' => 'form-control', 'style' => 'margin-bottom:15px')))//,'input' => 'string'
            ->add('showUntil', DateType::class, array('label'=> 'Show until','widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('placeholder' => 'yyyy-MM-dd','class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('begin', DateType::class, array('label'=> 'Begin Date','widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('placeholder' => 'yyyy-MM-dd','class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('description', TextType::class,array('label'=> 'Description','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('end', DateType::class, array('label'=> 'End Date','widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('placeholder' => 'yyyy-MM-dd','class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('moreInfo', TextType::class,array('label'=> 'More information','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('name', TextType::class,array('label'=> 'description','Name' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('price', TextType::class,array('label'=> 'Price','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            //->add('organizer', EntityType::class, ['class'=>Provider::class,'choice_label'=>'provider'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Internship::class,
        ]);
    }
}
