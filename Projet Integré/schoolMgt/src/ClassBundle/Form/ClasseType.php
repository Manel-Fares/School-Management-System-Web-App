<?php

namespace ClassBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClasseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')->add('niveau',ChoiceType::class,array(
            'choices'=>array(
                '1'=>'1',
                '2'=>'2',
                '3'=>'3',
                '4'=>'4',
                '5'=>'5'
            )
        ))->add('spec',ChoiceType::class,array(
            'choices'=>array(
                'Twin'=>'Twin',
                'A'=>'A',
                'B'=>'B',
                'DataScience'=>'DataScience',
                'Nids'=>'Nids',
                'Genie Logiciel'=>'Genie Logiciel',
                'Mobile'=>'Mobile',
                'Business Intelligence'=>'Business Intelligence'
            )
        ))->add('nbrEtudiant',NumberType::class)->add('description',TextareaType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'schoolBundle\Entity\Classe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'classbundle_classe';
    }


}
