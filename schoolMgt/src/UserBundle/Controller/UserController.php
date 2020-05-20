<?php

namespace UserBundle\Controller;

use schoolBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function afficherAction()
    {
        $u=$this->getDoctrine()->getRepository(Users::class)->findAll();

        return $this->render('UserBundle:User:afficher.html.twig', array(
            'users'=>$u,
        ));
    }


    public function profileEditAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $user = $repository->findOneBy([
            'id' => $this->getUser()->getId()
        ]);

        $form = $this->createFormBuilder($user)
            ->add('numteluser',NumberType::class,array(
                'label'=>'Phone Number'
            ))
            ->add('nomuser',TextType::class,array(
                'label'=>'Last Name',
            ))
            ->add('prenomuser',TextType::class,array(
                'label'=>'First Name'
            ))
            ->add('cinuser',NumberType::class,array(
                'label'=>'CIN Number'
            ))
            ->add('picuser',FileType::class, array(
                'label'=>'Select your avatar',
                'data_class' => null,

            ))
            ->add('sexeuser',ChoiceType::class,array(
                'choices'=> array('Homme'=>'homme','Femme'=>'femme'),
                'expanded'=>true,
                'multiple'=>false,
                'label'=>'Gender'
            ))


            ->add('Save',SubmitType::class,[

                'attr' => ['formnovalidate ' => 'formnovalidate']
            ])->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['picuser']->getData();
            if($file != null){
            $newImageName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('user_images'), $newImageName);
            $user->setPicuser($newImageName);}

            $em = $this->getDoctrine()->getManager();
            $em->flush();


            $authChecker = $this->container->get('security.authorization_checker');
            if($authChecker->isGranted('ROLE_ADMINISTRATEUR')) {
                return $this->render('UserBundle:User:profileAdmin.html.twig');

            }else if ($authChecker->isGranted('ROLE_ETUDIANT')){
                return $this->render('UserBundle:User:profileEtudiant.html.twig');

            }
            else if ($authChecker->isGranted('ROLE_ENSEIGNANT')){
                return $this->render('UserBundle:User:profileEnseignant.html.twig');

            }else if ($authChecker->isGranted('ROLE_PERSONNEL')){
                return $this->render('UserBundle:User:profilePersonnel.html.twig');
            }

        }

        $authChecker = $this->container->get('security.authorization_checker');
        if($authChecker->isGranted('ROLE_ADMINISTRATEUR')) {
            return $this->render('UserBundle:User:editadmin.hmtl.twig', array(
                'form'=>$form->createView()
            ));

        }else if ($authChecker->isGranted('ROLE_ETUDIANT')){
            return $this->render('UserBundle:User:editetudiant.html.twig', array(
                'form'=>$form->createView()
            ));
        }
        else if ($authChecker->isGranted('ROLE_ENSEIGNANT')){
            return $this->render('UserBundle:User:editenseignant.html.twig', array(
                'form'=>$form->createView()
            ));
        }else if ($authChecker->isGranted('ROLE_PERSONNEL')){
            return $this->render('UserBundle:User:editpersonnel.html.twig', array(
                'form'=>$form->createView()
            ));
        }


    }
    public function profileAction(Request $request)
    {

            $authChecker = $this->container->get('security.authorization_checker');
            if($authChecker->isGranted('ROLE_ADMINISTRATEUR')) {
                return $this->render('UserBundle:User:profileAdmin.html.twig');

            }else if ($authChecker->isGranted('ROLE_ETUDIANT')){
                return $this->render('UserBundle:User:profileEtudiant.html.twig');

            }
            else if ($authChecker->isGranted('ROLE_ENSEIGNANT')){
                return $this->render('UserBundle:User:profileEnseignant.html.twig');

            }else if ($authChecker->isGranted('ROLE_PERSONNEL')){
                return $this->render('UserBundle:User:profilePersonnel.html.twig');
            }


    }

}

