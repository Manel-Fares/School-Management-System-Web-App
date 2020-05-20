<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cinuser',ChoiceType::class,array(
                'choices'=> array('Homme'=>'homme','Femme'=>'femme'),
                'expanded'=>true,
                'multiple'=>false
            ))
            ->add('nomuser')
            ->add('prenomuser')
            ->add('username')
            ->add('datenaissanceuser',BirthdayType::class,array(
                'widget'=>'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('sexeuser')
            ->add('email',EmailType::class)
            ->add('adresseuser')
            ->add('numteluser')
            ->add('roles',ChoiceType::class,array(
                'choices'=> array(
                    'Administrateur'=> 'ROLE_AMDINISTRATEUR',
                    'Personnel'=> 'ROLE_PERSONNEL',
                    'Etudiant'=> 'ROLE_ETUDIANT',
                    'Enseignant'=> 'ROLE_ENSEIGNAT'
                ),
                'expanded'=>true,
                'multiple'=>false,
                'label'=>'roles'
            ));


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'schoolBundle\Entity\Users'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'schoolbundle_users';
    }


}
