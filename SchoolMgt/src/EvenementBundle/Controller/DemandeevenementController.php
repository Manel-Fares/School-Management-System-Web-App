<?php

namespace EvenementBundle\Controller;

use Doctrine\ORM\EntityRepository;
use EvenementBundle\Entity\Club;
use EvenementBundle\Entity\Demandeevenement;
use EvenementBundle\Entity\Evenement;
use EvenementBundle\Entity\Notification;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Demandeevenement controller.
 *
 * @Route("demandeevenement")
 */
class DemandeevenementController extends Controller
{
    /**
     * Lists all demandeevenement entities.
     *
     * @Route("/", name="demandeevenement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        // $Cl=new  Club();idclb
        $notifications=$this->getDoctrine()->getManager()->getRepository('EvenementBundle:Notification')->last();
        //   $club=$em->getRepository('EvenementBundle:Club')->find(1);

        //$ct=$Cl->getConstants();
        $idd = $em->getRepository('EvenementBundle:Demandeevenement')->idclb();
        //var_dump($idd);
        $aa = array();
        for($i=0;$i<count($idd);$i++){
            $bd = $em->getRepository('EvenementBundle:Demandeevenement')->top3($idd[$i]['idd']);
            //var_dump($bd);
            foreach ($bd as $r){
                $aa[$i]=$r;
            }


        }
        ////Tri par Selection

        for($k=0;$k<count($aa)-1;$k++) {
            $jMin = $k;
            for ($j = $k + 1; $j < count($aa); $j++) {
                if ($aa[$j]['x'] > $aa[$jMin]['x']) {
                    $jMin = $j;

                }
            }
            if ($jMin != $k)
            {
                $aux=$aa[$k];
                $aa[$k]=$aa[$jMin];
                $aa[$jMin]=$aux;

            }
        }

        /// ////

        $top3 = array_slice($aa, 0, 3);

        $demandeevenements = $em->getRepository('EvenementBundle:Demandeevenement')->findAll();

        return $this->render('demandeevenement/index.html.twig', array(
            'demandeevenements' => $demandeevenements,'bd'=>$top3,'notifications'=>$notifications
        ));
    }
    /**
     * Lists all demandeevenement entities.
     *
     * @Route("/bdg", name="bdget")
     * @Method("GET")
     */
    public function bbAction()
    {
        $em = $this->getDoctrine()->getManager();
        // $Cl=new  Club();idclb
        $notifications=$this->getDoctrine()->getManager()->getRepository('EvenementBundle:Notification')->last();
        //   $club=$em->getRepository('EvenementBundle:Club')->find(1);

        //$ct=$Cl->getConstants();
        $idd = $em->getRepository('EvenementBundle:Demandeevenement')->idclb();
        // var_dump($idd);
        $aa = array();
        for($i=0;$i<count($idd);$i++){
            $bd = $em->getRepository('EvenementBundle:Demandeevenement')->top3($idd[$i]['idd']);
            //var_dump($bd);
            foreach ($bd as $r){
                $aa[$i]=$r;
            }


        }
        ////Tri par Selection

        for($k=0;$k<count($aa)-1;$k++) {
            $jMin = $k;
            for ($j = $k + 1; $j < count($aa); $j++) {
                if ($aa[$j]['x'] > $aa[$jMin]['x']) {
                    $jMin = $j;

                }
            }
            if ($jMin != $k)
            {
                $aux=$aa[$k];
                $aa[$k]=$aa[$jMin];
                $aa[$jMin]=$aux;

            }
        }

        /// ////

        $top3 = array_slice($aa, 0, 3);

        $demandeevenements = $em->getRepository('EvenementBundle:Demandeevenement')->findAll();

        return $this->render('demandeevenement/budget.html.twig', array(
            'bd'=>$top3,
        ));
    }

    /**
     * Creates a new demandeevenement entity.
     *
     * @Route("/new", name="demandeevenement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $demandeevenement = new Demandeevenement();
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm('EvenementBundle\Form\DemandeevenementType', $demandeevenement);
        $form->add('clubnom',EntityType::class,[
            'class' => Club::class,
            'choice_label' => 'nomclub',
            'query_builder' => function (EntityRepository $er) {
                //$user = $this->container->get('security.token_storage')->getToken()->getUser();

                $user = $this->container->get('security.token_storage')->getToken()->getUser();
                return $er->createQueryBuilder('e')

                    ->where('e.idresponsable = :idresponsable')
                    ->setParameter('idresponsable',$user->getId());
            }
        ]);
        $form->handleRequest($request);
        $club=$em->getRepository('EvenementBundle:Club')->findOneBy(array('idresponsable'=>$form['clubnom']->getData()));
        // var_dump($form['clubnom']->getData());




        if ($form->isSubmitted() && $form->isValid()) {
            // var_dump($club);
            //var_dump($form['clubnom']->getData());
            $demandeevenement->setIdclub($form['clubnom']->getData());
            $demandeevenement->setEtat('non valider');
            if($form['file']->getData()!=null)
            {
                $demandeevenement->UploadProfilePicture();
            }else{    $demandeevenement->setImage('logo.png');}

            $em->persist($demandeevenement);
            $em->flush();

            return $this->redirectToRoute('demandeevenement_show_club');
        }

        return $this->render('demandeevenement/new.html.twig', array(
            'demandeevenement' => $demandeevenement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a demandeevenement entity.
     *
     * @Route("/show2", name="demandeevenement_show_club")
     * @Method("GET")
     */
    public function show2Action()
    {   $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $clubs = $em->getRepository('EvenementBundle:Club')->findBy(array('idresponsable'=>$user));
        $aa=array();
        for($i=0;$i<count($clubs);$i++)
        {
            $demandeevenement = $em->getRepository('EvenementBundle:Demandeevenement')->findBy(array('idclub'=>$clubs[$i]->getIdclub()));
            foreach ($demandeevenement as $r){

                array_push($aa,$r);
            }
        }

        return $this->render('demandeevenement/show2.html.twig', array(
            'demandeevenements' => $aa,

        ));
    }
    /**
     * Finds and displays a demandeevenement entity.
     *
     * @Route("/{iddemandeevenement}", name="demandeevenement_show")
     * @Method("GET")
     */
    public function showAction(Demandeevenement $demandeevenement)
    {
        $deleteForm = $this->createDeleteForm($demandeevenement);

        return $this->render('demandeevenement/show.html.twig', array(
            'demandeevenement' => $demandeevenement,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Finds and displays a demandeevenement entity.
     *
     * @Route("/showdetail2/{iddemandeevenement}", name="detail2")
     * @Method("GET")
     */
    public function showDetail2Action(Demandeevenement $demandeevenement)
    {
        $deleteForm = $this->createDeleteForm($demandeevenement);

        return $this->render('demandeevenement/showDetail2.html.twig', array(
            'demandeevenement' => $demandeevenement,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing demandeevenement entity.
     *
     * @Route("/{iddemandeevenement}/edit", name="demandeevenement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Demandeevenement $demandeevenement)
    {
        $deleteForm = $this->createDeleteForm($demandeevenement);
        $editForm = $this->createForm('EvenementBundle\Form\DemandeevenementType', $demandeevenement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if($editForm['file']->getData()==null)
            {
                $demandeevenement->UploadProfilePicture();
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demandeevenement_edit', array('iddemandeevenement' => $demandeevenement->getIddemandeevenement()));
        }

        return $this->render('demandeevenement/edit.html.twig', array(
            'demandeevenement' => $demandeevenement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing demandeevenement entity.
     *
     * @Route("/edit2/{iddemandeevenement}/edit", name="demandeevenement_edit2")
     * @Method({"GET", "POST"})
     */
    public function editDemandeAction(Request $request, Demandeevenement $demandeevenement)
    {
        $deleteForm = $this->createDeleteForm($demandeevenement);
        $editForm = $this->createForm('EvenementBundle\Form\DemandeevenementType', $demandeevenement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if($editForm['file']->getData()!=null)
            {
                $demandeevenement->UploadProfilePicture();
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demandeevenement_show_club');
        }

        return $this->render('demandeevenement/edit2.html.twig', array(
            'demandeevenement' => $demandeevenement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a demandeevenement entity.
     *
     * @Route("/{iddemandeevenement}/delete", name="demandeevenement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Demandeevenement $demandeevenement)
    {
        $form = $this->createDeleteForm($demandeevenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demandeevenement);
            $em->flush();
        }
        $user = $this->getUser();
        if ($user->hasRole('ROLE_PERSONNEL')) {
            return $this->redirectToRoute('demandeevenement_index');}
        else
            return $this->redirectToRoute('demandeevenement_show_club');
    }


    /**
     * Creates a form to delete a demandeevenement entity.
     *d
     * @param Demandeevenement $demandeevenement The demandeevenement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Demandeevenement $demandeevenement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demandeevenement_delete', array('iddemandeevenement' => $demandeevenement->getIddemandeevenement())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    /**
     * Displays a form to edit an existing demandeevenement entity.
     *
     * @Route("/{iddemandeevenement}/valider", name="demandeevenement_valider")
     * @Method({"GET", "POST"})
     */
    public function edit2Action(Request $request, Demandeevenement $demandeevenement)
    {
        $em=$this->getDoctrine()->getManager();
        $demandeevenement->setEtat("valider");
        $em->persist($demandeevenement);
        $em->flush();
        //  var_dump($demandeevenement->getIddemandeevenement());
        // $this->getDoctrine()->getManager()->flush();
        $evs=new Evenement();

        $club=$em->getRepository('EvenementBundle:Club')->find($demandeevenement->getIdclub());
        // var_dump($club);

        $evs->setIdclub($club);
        $evs->setDatedebut($demandeevenement->getDatedebut());
        $evs->setDatefin($demandeevenement->getDatefin());
        $evs->setImage($demandeevenement->getImage());
        // var_dump($evs);
        $em->persist($evs);

        $em->flush();
        $val=$demandeevenement->getEtat();
        return $this->render('demandeevenement/valider.html.twig', array(
            'valide' => $val,
        ));
        // return $this->redirectToRoute('demandeevenement_index');



    }
}
