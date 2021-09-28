<?php

namespace EvenementBundle\Controller;

use Doctrine\ORM\EntityRepository;
use EvenementBundle\Entity\Club;
use EvenementBundle\Entity\Evenement;
use EvenementBundle\Entity\Participation;
use EvenementBundle\Entity\Rate;
use EvenementBundle\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Evenement controller.
 *
 * @Route("evenement")
 */
class EvenementController extends Controller
{
    /**
     * Lists all evenement entities.
     *
     * @Route("/", name="evenement_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $notifications=$this->getDoctrine()->getManager()->getRepository('EvenementBundle:Notification')->last();

        $club=$em->getRepository('EvenementBundle:Club')->find(1);
        //  var_dump($club);
        $evenements = $em->getRepository('EvenementBundle:Evenement')->findAll();
        $entities  = $this->get('knp_paginator')->paginate(
            $evenements,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            12
        );
        return $this->render('evenement/index.html.twig', array(
            'evenements' => $entities,'notifications' => $notifications,
        ));
    }

    /**
     * Lists all evenement cl entities.
     *
     * @Route("/afficherEvenementClub", name="EvenementClub")
     * @Method("GET")
     */
    public function afficherEvenementClubAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        // var_dump($user);
        $evenements=array();
        $club=$em->getRepository('EvenementBundle:Club')->findOneBy(array('idresponsable'=>$user->getId()));
        $evenement = $em->getRepository('EvenementBundle:Evenement')->afficerSpecifiqueClub($club->getidClub());
        for($i=0;$i<count($evenement);$i++){
            //   var_dump($evenements[$i]['idevenement']);
            $p = $em->getRepository('EvenementBundle:Participation')->partEvclb($evenement[$i]['idevenement']);
            foreach ($p as $r){
                $evenements[$i]=$r;
                // array_push($aa,$r);
            }}
        // var_dump($evenements);
        //var_dump($club);
        // $evenements = $em->getRepository('EvenementBundle:Evenement')->afficerSpecifiqueClub($club);
        //var_dump($evenements);

        return $this->render('evenement/EvenementClub.html.twig', array(
            'evenements' => $evenements
        ));
    }
    /**
     * Lists all image  evenement entities.
     *
     * @Route("/image", name="evenement_image")
     * @Method("GET")
     */
    public function ListImageAction(Request $request)
    { $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $evenement = $em->getRepository('EvenementBundle:Evenement')->afficerSpecifique();
        $evenementnotpart = $em->getRepository('EvenementBundle:Participation')->notpart($user->getId());



        $clubs = $em->getRepository('EvenementBundle:Club')->findBy(array('idresponsable'=>$user));
        $ev = $em->getRepository('EvenementBundle:Evenement')->EvenementProch();

        $evenements=array();
        if($clubs!=null)
        {$tt=1;}
        else
        {  $tt=0;}
        //  var_dump($tt);
        for($i=0;$i<count($evenement);$i++){
            //   var_dump($evenements[$i]['idevenement']);
            $p = $em->getRepository('EvenementBundle:Participation')->partEvclb($evenement[$i]['idevenement']);
            foreach ($p as $r){
                $evenements[$i]=$r;
                // array_push($aa,$r);
            }}
        //   var_dump($evenements);
        //  $p = $em->getRepository('EvenementBundle:Participation')->partEvclb();
        $entities  = $this->get('knp_paginator')->paginate(
            $evenements,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            12
        );




        return $this->render('evenement/listImageEvenement.html.twig', array(
            'evenements' => $entities,'clubs'=>$tt,'ev'=>$ev,
        ));
    }
    /**
     * Lists all image  evenement entities.
     *
     * @Route("/imge", name="notpart")
     * @Method("GET")
     */
    public function ListImagenotpartAction(Request $request)
    { $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $evenement = $em->getRepository('EvenementBundle:Evenement')->afficerSpecifique();
        $evenementnotpart = $em->getRepository('EvenementBundle:Participation')->notpart($user->getId());


        $clubs = $em->getRepository('EvenementBundle:Club')->findBy(array('idresponsable'=>$user));
        $ev = $em->getRepository('EvenementBundle:Evenement')->EvenementProch();
        $evenements=array();
        if($clubs!=null)
        {$tt=1;}
        else
        {  $tt=0;}
        //  var_dump($tt);
        for($i=0;$i<count($evenementnotpart);$i++){
            //   var_dump($evenements[$i]['idevenement']);
            $p = $em->getRepository('EvenementBundle:Participation')->partEvclb($evenementnotpart[$i]['idevenement']);
            foreach ($p as $r){
                $evenements[$i]=$r;
                // array_push($aa,$r);
            }}
        //   var_dump($evenements);
        //  $p = $em->getRepository('EvenementBundle:Participation')->partEvclb();
        $entities  = $this->get('knp_paginator')->paginate(
            $evenements,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            12
        );




        return $this->render('evenement/notpart.html.twig', array(
            'evenements' => $entities,
        ));
    }
    /**
     * Lists all image detail  evenement entities.
     *
     * @Route("/detailevenement/{idevenement}", name="evenement_detail")
     * @Method({"GET", "POST"})
     */
    public function ListImageDetailAction(Request $request,$idevenement)
    { $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository('EvenementBundle:Participation')->partEvclb($idevenement);
        foreach ($p as $r){
            $evs=$r;
            // array_push($aa,$r);
        }
        //  $evs = $em->getRepository('EvenementBundle:Evenement')->find($idevenement+0);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $club=$em->getRepository('EvenementBundle:Club')->findOneBy(array('idresponsable'=>$user));
        // $p = $em->getRepository('EvenementBundle:Participation')->partEvclb($club->getidEvenement());
        //var_dump($club);
        /* $participation = new Participation();
         //var_dump($request);
         if($request->isMethod('POST'))
         {
             $em = $this->getDoctrine()->getManager();
             $participation->setIduser($user);
             $participation->setIdevenement($evs);
             $em->persist($participation);
             $em->flush();

             return $this->redirectToRoute('evenement_image');
         }*/
        /* $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $rate->setIduser($user);
             $rate->setIdclub($club);
             $em = $this->getDoctrine()->getManager();
             $em->persist($rate);
             $em->flush();

             return $this->redirectToRoute('evenement_image');
         }*/

        return $this->render('evenement/listImageEvenementxx.html.twig', array(
            'evenement' => $evs
        ));
    }
    /**
     * Lists all  Proche  evenement entities.
     *
     * @Route("/EvenementProche", name="evenement_Proche")
     * @Method("GET")
     */
    public function EvenementProAction(Request $request)
    { $em = $this->getDoctrine()->getManager();
        //$evenements=null;
        $ev = $em->getRepository('EvenementBundle:Evenement')->EvenementProch();
        //  var_dump($ev);
        //for ($i = 0; $i < sizeof($ev); $i++) {
        //$evenements = $em->getRepository('EvenementBundle:Evenement')->find(12);
        $entities  = $this->get('knp_paginator')->paginate(
            $ev,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            4
        );


        // }
        //  var_dump($ev);
        //bara hani ok

        return $this->render('evenement/procheEvenement.html.twig', array(
            'evenements' => $entities,
        ));
    }
    /**
     * Creates a new evenement entity.
     *
     * @Route("/new", name="evenement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {            $em = $this->getDoctrine()->getManager();

        $evenement = new Evenement();
        $c=new Club();
        $form = $this->createForm('EvenementBundle\Form\EvenementType', $evenement);

        $form->handleRequest($request);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $club=$em->getRepository('EvenementBundle:Club')->findOneBy(array('idresponsable'=>$user));

        if ($form->isSubmitted() && $form->isValid()) {
            $evenement->setIdclub($club);
            if($form['file']->getData()!=null)
            {
                $evenement->UploadProfilePicture();
            }else{    $evenement->setImage('logo.png');}
            var_dump($form['file']->getData());
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/new.html.twig', array(
            'evenement' => $evenement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evenement entity.
     *
     * @Route("/{idevenement}", name="evenement_show")
     * @Method("GET")
     */
    public function showAction(Evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);

        return $this->render('evenement/show.html.twig', array(
            'evenement' => $evenement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evenement entity.
     *
     * @Route("/{idevenement}/edit", name="evenement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);
        $editForm = $this->createForm('EvenementBundle\Form\EvenementType', $evenement);
        $user = $this->getUser();

        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if($editForm['file']->getData()!=null){$evenement->UploadProfilePicture();
            }

            $this->getDoctrine()->getManager()->flush();
            if ($user->hasRole('ROLE_PERSONNEL')) {
                return $this->redirectToRoute('evenement_index');
            }
            else
                return $this->redirectToRoute('EvenementClub');
        }



        if ($user->hasRole('ROLE_PERSONNEL')) {
            return $this->render('evenement/edit.html.twig', array(
                'evenement' => $evenement,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));}
        else {

            return $this->render('evenement/edit2.html.twig', array(
                'evenement' => $evenement,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));}
    }

    /**
     * Deletes a evenement entity.
     *
     * @Route("/{idevenement}/delete", name="evenement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Evenement $evenement)
    {
        $form = $this->createDeleteForm($evenement);
        $form->handleRequest($request);
        //  var_dump($evenement);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evenement);
            $em->flush();
        }
        $user = $this->getUser();
        if ($user->hasRole('ROLE_PERSONNEL')) {
            return $this->redirectToRoute('evenement_index');
        }else{return $this->redirectToRoute('EvenementClub');}
    }

    /**
     * Creates a form to delete a evenement entity.
     *
     * @param Evenement $evenement The evenement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Evenement $evenement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenement_delete', array('idevenement' => $evenement->getIdevenement())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    public function EventNotparticiper()
    {

    }
    /***********************************************************/
    public function allAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Evenement')
            ->findAll();

        for($i=0;$i<count($tasks);$i++)
        {
            $tasks[$i]->setDatefin($tasks[$i]->getDatefin()->format('Y-m-d')) ;
            $tasks[$i]->setDatedebut($tasks[$i]->getDatedebut()->format('Y-m-d')) ;
        }

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function AllDetailleAction($idevenement)
    {
        $em = $this->getDoctrine()->getManager();
        $aa = array();
        $partuser = $em->getRepository('EvenementBundle:Participation')->find($idevenement);
        $p = $em->getRepository('EvenementBundle:Participation')->partEvclb($idevenement);

        if($p==null)
        {
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($partuser);
            return new JsonResponse($formatted);}


        else
        {
            foreach ($p as $r){
                $evs=$r;
                array_push($aa,$r);

            }


            for($i=0;$i<count($aa);$i++){
                $aa[$i]['datedebut']=$aa[$i]['datedebut']->format('Y-m-d');
                $aa[$i]['datefin']=$aa[$i]['datefin']->format('Y-m-d');
            }
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($aa);
            return new JsonResponse($formatted);
        }
    }



    public function TestAction($idu,$ide){
        $em = $this->getDoctrine()->getManager();
        $Parateuser=$em->getRepository('EvenementBundle:Participation')->testt($ide,$idu);
        $aa = array();




        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Parateuser);
        return new JsonResponse($formatted);}


    public function addAction($ide,$idu)
    {
        $em = $this->getDoctrine()->getManager();
        $Part = new Participation();
        $Parateuser=$em->getRepository('EvenementBundle:Participation')->findOneBy(array('iduser'=>$idu));
        $user=$em->getRepository('EvenementBundle:Users')->find($idu);
        $evenemnt=$em->getRepository('EvenementBundle:Evenement')->find($ide);
        if($Parateuser==null)
        {
            $Part->setIduser($user);
            $Part->setIdevenement($evenemnt);
            $em->persist($Part);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($Part);
            return new JsonResponse($formatted);}
        else
        {
            $em->remove($Parateuser);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($Parateuser);
            return new JsonResponse($formatted);}

    }

    public function PartEventAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evenement = $em->getRepository('EvenementBundle:Evenement')->afficerSpecifique();
        // var_dump($evenements);
        for($i=0;$i<count($evenement);$i++){
            //   var_dump($evenements[$i]['idevenement']);
            $p = $em->getRepository('EvenementBundle:Participation')->partEvclbtop5($evenement[$i]['idevenement']);
            foreach ($p as $r){
                $evenements[$i]=$r;
                // array_push($aa,$r);
            }}
        for($k=0;$k<count($evenements)-1;$k++) {
            $jMin = $k;
            for ($j = $k + 1; $j < count($evenements); $j++) {
                if ($evenements[$j]['x'] > $evenements[$jMin]['x']) {
                    $jMin = $j;

                }
            }
            if ($jMin != $k)
            {
                $aux=$evenements[$k];
                $evenements[$k]=$evenements[$jMin];
                $evenements[$jMin]=$aux;

            }
        }

        /// ////

        $top3 = array_slice($evenements, 0, 5);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($top3);
        return new JsonResponse($formatted);
    }

}
