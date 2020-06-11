<?php
/**
 * Created by PhpStorm.
 * User: Aymen
 * Date: 12/04/2020
 * Time: 02:19
 */

namespace UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationBaseType ;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('numteluser',NumberType::class)
           ->add('nomuser')
           ->add('prenomuser')
           ->add('cinuser',NumberType::class)


           ->add('datenaissanceuser',BirthdayType::class,array(
               'label' =>'Birth Date',

               'format' => 'yyyy-MM-dd'))
          /* ->add('sexeuser',ChoiceType::class,array(
               'choices'=> array('Homme'=>'homme','Femme'=>'femme'),
               'expanded'=>true,
               'multiple'=>false,
               'label'=>'Sexe'
           ))*/

           ->add('roles',ChoiceType::class,array(
               'choices'=> array(
                   'Administrator'=> 'ROLE_AMDIN',
                   'Staff'=> 'ROLE_PERSONNEL',
                   'Student'=> 'ROLE_ETUDIANT',
                   'Teacher'=> 'ROLE_ENSEIGNIANT'
               ),
               'required'=>true,
               'multiple'=>true,
               'label'=>'roles'
           ));

    }

    public  function getParent()
    {
        return BaseRegistrationBaseType::class;
    }

}