<?php

namespace SubjectsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class QQuizType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('question', TextType::class, array('label' => 'Question',
            'constraints' => array(
                new NotBlank(array("message" => "This field shouldn t be blank")),
            )
        ))
            ->add('ans1', TextType::class, array('label' => 'Option 1',
                'constraints' => array(
                    new NotBlank(array("message" => "This field shouldn t be blank")),
                )
            ))
            ->add('ans2', TextType::class, array('label' => 'Option 2',
                'constraints' => array(
                    new NotBlank(array("message" => "This field shouldn t be blank")),
                )
            ))
            ->add('ans3', TextType::class, array('label' => 'Option 3',
                'constraints' => array(
                    new NotBlank(array("message" => "This field shouldn t be blank")),
                )
            ))
            ->add('cans', TextType::class, array('label' => 'Correct Answer',
                'constraints' => array(
                    new NotBlank(array("message" => "This field shouldn t be blank")),
                )
            ))
            ->add('Add Quiz Question',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SubjectsBundle\Entity\QQuiz'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'subjectsbundle_qquiz';
    }


}
