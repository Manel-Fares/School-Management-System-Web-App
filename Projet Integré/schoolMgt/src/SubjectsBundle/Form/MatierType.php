<?php

namespace SubjectsBundle\Form;

use Doctrine\ORM\EntityRepository;
use schoolBundle\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatierType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom' ,TextType::class, array('label' => 'Name'))

        ->add('coef',NumberType::class, array('label' => 'Coefficient'))
            ->add('responsable',EntityType::class,[
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
            ->add('Confirm new subject',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'schoolBundle\Entity\Matier'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'schoolbundle_matier';
    }


}
