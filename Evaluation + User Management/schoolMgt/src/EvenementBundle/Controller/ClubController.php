<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Club;
use EvenementBundle\Entity\Evenement;
use EvenementBundle\Entity\Rate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Club controller.
 *
 * @Route("club")
 */
class ClubController extends Controller
{
    /**
     * Lists all club entities.
     *
     * @Route("/", name="club_index")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    { $em = $this->getDoctrine()->getManager();

        $clubs = $em->getRepository('EvenementBundle:Club')->findAll();
        if($request ->isMethod('post')){
            $varr=$request->get('search');
            $clubs = $em->getRepository('EvenementBundle:Club')->search($varr);
        }



        return $this->render('club/index.html.twig', array(
            'clubs' => $clubs,
        ));
    }

    /**
     * Finds and displays a club Image .
     *
     * @Route("/ListImage", name="club_show_image")
     * @Method("GET")
     */
    public function ListImageAction(Request $request)
    { $em = $this->getDoctrine()->getManager();

        $clubs = $em->getRepository('EvenementBundle:Club')->ClubUser();
//var_dump($clubs);
        $aa = array();
        for ($i=0;$i<count($clubs);$i++) {

            $Rates = $em->getRepository('EvenementBundle:Club')->ClubRate($clubs[$i]['idclub']);
            //  var_dump($Rates);
            foreach ($Rates as $r){
                $aa[$i]=$r;
                // array_push($aa,$r);
            }}
        //var_dump($Rates);
        //var_dump($aa);
        $entities  = $this->get('knp_paginator')->paginate(
            $clubs,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            4/*nbre d'éléments par page*/
        );
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $club=$em->getRepository('EvenementBundle:Club')->findOneBy(array('idresponsable'=>$user));
        /*   $rate = new Rate();
           $form = $this->createForm('EvenementBundle\Form\RateType', $rate);
           $form->handleRequest($request);

           if ($form->isSubmitted() && $form->isValid()) {
               $rate->setIduser($user);
               $rate->setIdclub($club);
               $em = $this->getDoctrine()->getManager();
               $em->persist($rate);
               $em->flush();

               return $this->redirectToRoute('evenement_image');
           }*/

        return $this->render('club/listImageClub.html.twig', array(
            'clubs' => $entities,'aa'=>$aa,/*'rate' => $rate,
            'form' => $form->createView(),*/
        ));
    }

    /**
     * Creates a new club entity.
     *
     * @Route("/new", name="club_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $club = new Club();

        //  $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm('EvenementBundle\Form\ClubType', $club);
        $form->handleRequest($request);
        // var_dump($user);

        // $club->setIdresponsable($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $club->UploadProfilePicture();

            $em->persist($club);
            $em->flush();

            return $this->redirectToRoute('club_show', array('idclub' => $club->getIdclub()));
        }

        return $this->render('club/new.html.twig', array(
            'club' => $club,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a club entity.
     *
     * @Route("/{idclub}", name="club_show")
     * @Method("GET")
     */
    public function showAction(Club $club)
    {
        $deleteForm = $this->createDeleteForm($club);
        $em = $this->getDoctrine()->getManager();
        $Cl=new  Club();

        var_dump($club->getIdclub());
        $ct=$Cl->getConstants();
        $bd = $em->getRepository('EvenementBundle:Demandeevenement')->budgetEvenementClub($club->getIdclub());

        $clubs = $em->getRepository('EvenementBundle:Club')->nbrEvenementClub($club->getIdclub());
        var_dump($clubs);
        $evenements= $em->getRepository('EvenementBundle:Evenement')->nbrEvenementTotale();

        return $this->render('club/show.html.twig', array(
            'club' => $club,
            'delete_form' => $deleteForm->createView(),'clubs' => $clubs,'evenements'=>$evenements,'bd'=>$bd,'ct'=>$ct
        ));
    }

    /**
     * Displays a form to edit an existing club entity.
     *
     * @Route("/{idclub}/edit", name="club_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Club $club)
    {
        $deleteForm = $this->createDeleteForm($club);
        $editForm = $this->createForm('EvenementBundle\Form\ClubType', $club);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('club_edit', array('idclub' => $club->getIdclub()));
        }
        $user = $this->getUser();
        if ($user->hasRole('ROLE_ADMIN')) {
            return $this->render('club/edit.html.twig', array(
                'club' => $club,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));}
        else  {
            return $this->render('club/edit2.html.twig', array(
                'club' => $club,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));}
    }

    /**
     * Deletes a club entity.
     *
     * @Route("/{idclub}/delete", name="club_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Club $club)
    {
        $form = $this->createDeleteForm($club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($club);
            $em->flush();
        }

        return $this->redirectToRoute('club_index');
    }

    /**
     * Creates a form to delete a club entity.
     *
     * @param Club $club The club entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Club $club)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('club_delete', array('idclub' => $club->getIdclub())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


    public function nbrEvenementClubAction()
    {
        $em = $this->getDoctrine()->getManager();
        $bb = $em->getRepository('EvenementBundle:Evenement')->xx();

        $clubs = $em->getRepository('EvenementBundle:Club')->nbrEvenementClub();
        $evenements= $em->getRepository('EvenementBundle:Evenement')->nbrEvenementTotale();

        var_dump($bb);
        return $this->render('club/xx.html.twig', array(
            'clubs' => $clubs,'evenements'=>$evenements
        ));
    }



    /****************************************************************************/
    /*
        /**
         * Lists all image detail  club entities.
         *
         * @Route("/club/{idclub}", name="club_detail")
         * @Method("GET")
         */
    /*  public function ListImageDetailAction(Request $request,$idclub)
      { $em = $this->getDoctrine()->getManager();

          $aa = $em->getRepository('EvenementBundle:Club')->find($idclub+0);
          $user = $this->container->get('security.token_storage')->getToken()->getUser();
         // $club=$em->getRepository('EvenementBundle:Club')->findOneBy(array('idresponsable'=>$user));
         var_dump($aa);
          $rate = new Rate();
          $form = $this->createForm('EvenementBundle\Form\RateType', $rate);
          $form->handleRequest($request);
         // var_dump($rate);
          var_dump($form['rating']->getData());
          if ($form->isSubmitted() && $form->isValid()) {
              var_dump($user);
              $rate->setIduser($user);
              $rate->setIdc($aa);
              var_dump($rate);
              $em = $this->getDoctrine()->getManager();
              $em->persist($rate);
              $em->flush();

              //return $this->redirectToRoute('evenement_image');
          }
          else

          /* $form->handleRequest($request);

           if ($form->isSubmitted() && $form->isValid()) {
               $rate->setIduser($user);
               $rate->setIdclub($club);
               $em = $this->getDoctrine()->getManager();
               $em->persist($rate);
               $em->flush();

               return $this->redirectToRoute('evenement_image');
           }*/

    /*  return $this->render('club/rate.html.twig', array(
          'aa' =>$aa,'rate' => $rate,
          'form' => $form->createView(),
      ));
  }*/

    /*
    ******************************* partie mobile *****************************/
    public function allAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Club')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    public function all2Action($idclub)
    {
        $club = $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Club')
            ->ClubRate($idclub);
        $clubb = $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Club')->find($idclub);

        if($club==null)
        {

            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($clubb);
            return new JsonResponse($formatted);
        }else{
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($club);
            return new JsonResponse($formatted);
        }}
    public function addAction($rating,$idc,$idu)
    {
        $em = $this->getDoctrine()->getManager();
        $Rate = new Rate();;
        $rateuser=$em->getRepository('EvenementBundle:Rate')->findOneBy(array('iduser'=>$idu));

        // $rateuser=$em->getRepository('EvenementBundle:Rate')->find($idu);
        $user=$em->getRepository('EvenementBundle:Users')->find($idu);
        $club=$em->getRepository('EvenementBundle:Club')->find($idc);
        //var_dump( $rateuser->getIduser()->getId());
        if($rateuser==null)
        {
            $Rate->setRating($rating);
            $Rate->setIduser($user);
            $Rate->setIdc($club);
            $em->persist($Rate);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($Rate);
            return new JsonResponse($formatted);

        }
        else{
            $rateuser->setRating($rating);
            $em->persist($rateuser);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($rateuser);
            return new JsonResponse($formatted);
        }}
    public function recupererClubSpecifiqueAction($x)
    {

        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Club')
            ->responsableclub($x);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);

    }
    /*
    ******************************* partie mobile *****************************/
    public function allClubAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EvenementBundle:Club')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }




















}
