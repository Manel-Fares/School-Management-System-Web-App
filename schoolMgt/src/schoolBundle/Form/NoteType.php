<?php

namespace schoolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etudiant',TextType::class)
            ->add('matiere',TextType::class)
            ->add('enseignant',TextType::class)
            ->add('datenote',DateTimeType::class,[
                        'widget' => 'single_text',
                        'format' => 'yyyy-MM-dd',])
            ->add('notecc',NumberType::class)
            ->add('noteds',NumberType::class)
            ->add('noteexam',NumberType::class)
            ->add('moyenne',NumberType::class)
            ->add('Envoyer',SubmitType::class)
            ->add('reinitialiser',ResetType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'schoolBundle\Entity\Note'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'schoolbundle_note';
    }


}
