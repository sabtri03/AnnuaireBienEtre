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
            ->add('showDate', DateType::class, array('widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('placeholder' => 'yyyy-MM-dd',)))//,'input' => 'string'
            ->add('showUntil', DateType::class, array('widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('placeholder' => 'yyyy-MM-dd',)))
            ->add('begin', DateType::class, array('widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('placeholder' => 'yyyy-MM-dd',)))
            ->add('description', TextType::class)
            ->add('end', DateType::class, array('widget' => 'single_text','format' => 'yyyy-MM-dd','attr' => array('placeholder' => 'yyyy-MM-dd',)))
            ->add('moreInfo', TextType::class)
            ->add('name', TextType::class)
            ->add('price', TextType::class)
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
