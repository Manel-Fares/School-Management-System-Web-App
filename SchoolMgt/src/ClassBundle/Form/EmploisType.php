<?php

namespace ClassBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
class EmploisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date',DateType::class)->add('heure',TimeType::class)->add('source',
            FileType::class,[
        'label' => 'Brochure (PDF file)',


                'mapped' => false,

                'required' => false,

                'constraints' => [
        new File([
            'maxSize' => '3094k',
            'mimeTypes' => [
                'application/pdf',
                'application/x-pdf',
            ],
            'mimeTypesMessage' => 'Please upload a valid PDF document',
        ])
    ],
            ])

            ->add('nameclas',EntityType::class,array(
                'class'=>'schoolBundle:Classe',
                'choice_label'=>'name',
                'multiple'=>false
            ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClassBundle\Entity\Emplois'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'classbundle_emplois';
    }


}
