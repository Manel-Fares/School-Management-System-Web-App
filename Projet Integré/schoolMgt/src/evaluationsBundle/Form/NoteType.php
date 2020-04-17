<?php

namespace evaluationsBundle\Form;

use Doctrine\ORM\EntityRepository;
use schoolBundle\Entity\Matier;
use schoolBundle\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add('etudiant',EntityType::class,[
                'class' => Users::class,
                'choice_label' => 'cinUser',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->select('e')
                        ->where('e.roleuser = :roleuser')
                        ->andWhere()
                        ->setParameter('roleuser','Etudiant');

                }
            ])

        ->add('matiere',EntityType::class,[

            'class' => Matier::class,
            'choice_label' => 'nom'
    ])

        ->add('datenote',DateType::class,[
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',])
        ->add('notecc',NumberType::class,[
            'attr' => [
                'min' => 0,
                'max' => 20
            ]
        ])
        ->add('noteds',NumberType::class,[
            'attr' => [
                'min' => 0,
                'max' => 20
            ]
        ])
        ->add('noteexam',NumberType::class)

        ->add('Envoyer',SubmitType::class,[
            'attr' => ['formnovalidate ' => 'formnovalidate']
        ])
        ->add('reinitialiser  ',ResetType::class);
    }/**
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
