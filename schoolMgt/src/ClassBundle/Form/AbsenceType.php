<?php

namespace ClassBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbsenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date',DateType::class)->add('timedeb',TimeType::class
        )->add('timefin',TimeType::class)->add('idMatiere',EntityType::class,array(
            'class'=>'schoolBundle:Matier',
            'choice_label'=>'nom',
            'multiple'=>false
        ))->add('idUser',EntityType::class,array(
            'class'=>'schoolBundle:Users',
            'choice_label'=>'nomuser',
            'multiple'=>false
        ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClassBundle\Entity\Absence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'classbundle_absence';
    }


}
