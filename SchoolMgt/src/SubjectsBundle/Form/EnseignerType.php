<?php

namespace SubjectsBundle\Form;

use Doctrine\ORM\EntityRepository;
use schoolBundle\Entity\Matier;
use schoolBundle\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnseignerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idmatiere',EntityType::class,[
            'label' => 'Subject',
            'class' => Matier::class,
            'choice_label' => 'nom',
        ])
            ->add('idenseignant',EntityType::class,[
        'label' => 'Teacher',
        'class' => Users::class,
        'choice_label' => 'cinUser',
        'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('e')
                ->select('e')
                ->where('e.roles Like :role')
                ->setParameter('role', '%"'.'ROLE_ENSEIGNANT'.'"%');

        }
    ])
            ->add('add teacher to subject',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClassBundle\Entity\Enseigner'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'subjectsbundle_chapters';
    }


}
