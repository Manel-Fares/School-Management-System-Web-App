<?php

namespace UserBundle\Controller;

use schoolBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use UserBundle\Form\forgotPasswordType;
use Symfony\Component\Validator\Constraints\File;


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
                'constraints' => array(
                    new NotBlank(array("message" => "Please provide your Last Name")),
                )
            ))
            ->add('prenomuser',TextType::class,array(
                'label'=>'First Name',
                'constraints' => array(
                    new NotBlank(array("message" => "Please provide your First Name")),
                )
            ))
            ->add('cinuser',NumberType::class,array(
                'label'=>'CIN Number',
                'constraints' => array(
                    new NotBlank(array("message" => "Please provide your CIN Number"))

                )

            ))
            ->add('sexeuser',ChoiceType::class,array(
                'choices'=> array('Male'=>'Male','Female'=>'Female'),
                'multiple'=>false,
                'label'=>'Gender'
            ))
            ->add('picuser',FileType::class, array(
                'label'=>'Select your avatar',
                'data_class' => null,


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
                $em = $this->getDoctrine()->getManager();
                $user = $this->container->get('security.token_storage')->getToken()->getUser();
                $clubs = $em->getRepository('EvenementBundle:Club')->findBy(array('idresponsable'=>$user));
                if($clubs!=null)
                {$tt=1;}
                else
                {  $tt=0;}
                var_dump($tt);
                return $this->render('UserBundle:User:profileEtudiant.html.twig', array(
                    'clubs'=>$tt
                ));

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
                $em = $this->getDoctrine()->getManager();
                $user = $this->container->get('security.token_storage')->getToken()->getUser();
                $clubs = $em->getRepository('EvenementBundle:Club')->findBy(array('idresponsable'=>$user));
                if($clubs!=null)
                {$tt=1;}
                else
                {  $tt=0;}
                var_dump($tt);
                return $this->render('UserBundle:User:profileEtudiant.html.twig', array(
                    'clubs'=>$tt
                ));

            }
            else if ($authChecker->isGranted('ROLE_ENSEIGNANT')){
                return $this->render('UserBundle:User:profileEnseignant.html.twig');

            }else if ($authChecker->isGranted('ROLE_PERSONNEL')){
                return $this->render('UserBundle:User:profilePersonnel.html.twig');
            }


    }



    public function forgotpasswordAction(Request $request)
    {
        $form = $this->createForm(forgotPasswordType::class,null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('forgot_password_sms'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid() ){
                $email=$form['email']->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $query = $entityManager->createQuery(
                    'SELECT u
                     FROM schoolBundle:Users u        
                     WHERE u.email = :email'

                )->setParameter(
                    'email',$email
                );
                $user = $query->getResult();
                if(empty($user)){
                    $form->addError(new FormError('please provide your school email'));
                    // $this->addFlash('error', 'Wrong username !!!');
                    return $this->render('@User/User/forgotpassword.html.twig', array(
                        'form' => $form->createView()
                    ));

                } else {
                    $transporter = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                        ->setUsername('velov638@gmail.com')
                        ->setPassword('Velo123456789.');
                    $mailer = \Swift_Mailer::newInstance($transporter);



                    $message = (new \Swift_Message('forgot Password'))
                        ->setFrom($email)
                        ->setTo($email)
                        ->setBody('We recieved a request for forgotten password. '."\n".'This is your password: '.$user[0]->getPassword())
                    ;
                    $mailer->send($message);
                }
                /*$basic  = new \Nexmo\Client\Credentials\Basic('12d2fd01', 'sVopO9PurQHuW7Nf');
                 $client = new \Nexmo\Client($basic);
                 $pw=$user[0]->getPassword();

                 $client->message()->send([
                     'to' => '21621997061',
                     'from' => 'Forgot Password',
                     'text' => 'your password is:'
                 ]);
                $url = 'https://rest.nexmo.com/sms/json?' . http_build_query([
                        'api_key' => '12d2fd01',
                        'api_secret' => 'sVopO9PurQHuW7Nf',
                        'to' => '21621997061',
                        'from' => 'forgotPassword',
                        'text' => 'your password is '
                    ]);

                 $ch = curl_init($url);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                 $response = curl_exec($ch);
                 var_dump($response);*/

                return $this->redirectToRoute('fos_user_security_login');


            }

        }
        return $this->render('@User/User/forgotpassword.html.twig', array(
            'form' => $form->createView()
        ));



    }

}

