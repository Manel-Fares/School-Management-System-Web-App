<?php
/**
 * Created by PhpStorm.
 * User: Aymen
 * Date: 22/04/2020
 * Time: 23:37
 */

namespace evaluationsBundle\Form;


class FiltreType extends AbstractType
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
                        ->select('e');
                    // ->where('e.roleuser = :roleuser')
                    //->andWhere()
                    //->setParameter('roleuser','Etudiant');

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
