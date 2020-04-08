<?php

namespace schoolBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use schoolBundle\Entity\Resultat;
use schoolBundle\Form\ResultatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resultat controller.
 *
 */
class ResultatController extends Controller
{


    public function indexAction(){
        $resultat= $this->getDoctrine()->getRepository(Resultat::class)->findAll();
        return $this->render("@school/Resultat/read.html.twig",array("resultat"=>$resultat));
    }

    public function calculerAction(){
        $entityManager = $this->getDoctrine()->getManager();
        $liste=$entityManager
            ->createQuery("SELECT distinct n.etudiant FROM schoolBundle:Note n ");
        $listeEtudiant = $liste->getResult();

        for($j=0;$j<count($listeEtudiant);$j++)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $query = $entityManager->createQuery(
            'SELECT n.moyenne,
             m.coef
             FROM schoolBundle:Note n
             LEFT JOIN schoolBundle:Matier m
             WITH n.matiere = m.id                     
             WHERE n.etudiant = :etudiant'
            )->setParameter('etudiant',$listeEtudiant[$j]['etudiant'] );
            $listeNote = $query->getResult();

            $sumcCoef=0;
            $sumMoy=0;
            for($i=0;$i<count($listeNote);$i++) {
                $sumcCoef += $listeNote[$i]['coef'];
                $sumMoy += $listeNote[$i]['moyenne']*$listeNote[$i]['coef'];
            }
            $resultat = new Resultat();
            $resultat->setEtudiant($listeEtudiant[$j]['etudiant']);
            $date = new \DateTime('now', new \DateTimeZone('Asia/Kolkata'));
            $date->format('yy-m-d');
            $resultat->setDateresultat($date);
            $resultat->setResultat($sumMoy/$sumcCoef);
            $em = $this->getDoctrine()->getManager();
            $em->persist($resultat);
            $em->flush();
        }


        return $this->redirectToRoute('resultat__management');
    }

    public  function  pfdAction(Request $request){
        $snappy = $this->get("knp_snappy.pdf");
        $filename = "resultat";
        $html = $this->renderView("schoolBundle:Note:read.html.twig");
        return new Response(
            $snappy->getOutput($html),
            200,
        array(
            'Content-Type'=>'application/pdf',
            'Content-Disposition'=>'inline; filename="'.$filename.'.pdf"'
        )
        );
    }
    public function resutlatEtudiantAction()
    {
        $matiere =array();
        $enseignant =array();

        $em=$this->getDoctrine()->getManager();

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT n.notecc,
             n.noteds,
             n.moyenne,
             n.noteexam,
             m.nom,
             m.coef,
             u.nomuser,
             u.prenomuser
             FROM schoolBundle:Note n
             LEFT JOIN schoolBundle:Matier m
             WITH n.matiere = m.id
             LEFT JOIN schoolBundle:Users u
             WITH u.id = n.enseignant             
             WHERE n.etudiant = :etudiant'
        )->setParameter('etudiant',1 );

        $note = $query->getResult();

        $query2 = $entityManager->createQuery(
            'SELECT r.resultat
             FROM schoolBundle:Resultat r            
             WHERE r.etudiant = :etudiant'
        )->setParameter('etudiant',1 );

        $res = $query2->getResult();
        dump($res);
        return $this->render('@school/Resultat/affichageResultatEtudiant.html.twig',
            array('note'=>$note,'resultat'=>$res));
    }

    public function gererResultatsAction(){

            $entityManager = $this->getDoctrine()->getManager();
            $query = $entityManager->createQuery(
                'SELECT r.etudiant,
                r.resultat,
             u.cinuser,
             u.nomuser,
             u.prenomuser
             FROM schoolBundle:Resultat r
             LEFT JOIN schoolBundle:Users u
             WITH u.id = r.etudiant '
             );

            $res = $query->getResult();

            return $this->render('@school/Resultat/gestionResultat.html.twig',array('resultat'=>$res));


    }
    public function detailResultatAction(Request $request,$idetudiant){


        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT n.notecc,
             n.noteds,
             n.moyenne,
             n.noteexam,
             m.nom,
             m.coef,
             u.nomuser,
             u.prenomuser,
             u.classeetd
             FROM schoolBundle:Note n
             LEFT JOIN schoolBundle:Matier m
             WITH n.matiere = m.id
             LEFT JOIN schoolBundle:Users u
             WITH u.id = n.enseignant             
             WHERE n.etudiant = :etudiant'
        )->setParameter('etudiant',$idetudiant );

        $note = $query->getResult();

        $query2 = $entityManager->createQuery(
            'SELECT r.resultat
             FROM schoolBundle:Resultat r            
             WHERE r.etudiant = :etudiant'
        )->setParameter('etudiant',$idetudiant );

        $res = $query2->getResult();

        return $this->render('@school/Resultat/detail.html.twig',
            array('note'=>$note,'resultat'=>$res));


    }

    public function statistiqueReussiteAction()
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $res = $em->getRepository(Resultat::class)->findAll();
        $totalEtudiant=count($res);

            $succes=0;
            $echec=0;
            dump($res);
        for($j=0;$j<count($res);$j++)
        {

            if ($res[$j]->getResultat() >= 10) {
                $succes += 1;
            } else {
                $echec += 1;
            }
        }
           $succes=$succes*100/$totalEtudiant;
            $echec=$echec*100/$totalEtudiant;

    /*    $stat=['pourcentage Resussite', 'pourcentage Echec'];
        array_push($stat,$succes,$echec);*/

        $pieChart->getData()->setArrayToDataTable(
            [['Resussite','pourcentage de reussite'],
                ['Success',$succes],
            ['Failure',$echec]

                ]
        );
       /* $pieChart->getOptions()->setTitle('Pourcentages de Reussite');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);*/
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009905');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@school/Resultat/statistique.html.twig', array('piechart' => $pieChart));
    }
    public function deleteAction($idetudiant)
    {

        $repository = $this->getDoctrine()->getRepository(Resultat::class);
        $res = $repository->findOneBy([
            'etudiant' => $idetudiant
        ]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($res);
        $entityManager->flush();
        return $this->redirectToRoute('resultat__management');
    }


}
