<?php

namespace evaluationsBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use schoolBundle\Entity\Classe;
use schoolBundle\Entity\Club;
use schoolBundle\Entity\Resultat;
use schoolBundle\Entity\Users;
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
        return $this->render("@evaluations/Resultat/read.html.twig",array("resultat"=>$resultat));
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
            'SELECT n.moyenne, m.coef FROM schoolBundle:Note n
             LEFT JOIN schoolBundle:Matier m  WITH n.matiere = m.id                     
             WHERE n.etudiant = :etudiant'
            )->setParameter('etudiant',$listeEtudiant[$j]['etudiant'] );
            $listeNote = $query->getResult();

            $sumcCoef=0;  $sumMoy=0;
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
        $html = $this->renderView("evaluationsBundle:Note:read.html.twig");
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
        )->setParameter('etudiant',$this->getUser()->getID()  );

        $note = $query->getResult();

        $query2 = $entityManager->createQuery(
            'SELECT r.resultat
             FROM schoolBundle:Resultat r            
             WHERE r.etudiant = :etudiant'
        )->setParameter('etudiant',1 );

        $res = $query2->getResult();
        dump($res);
        return $this->render('@evaluations/Resultat/affichageResultatEtudiant.html.twig',
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

            return $this->render('@evaluations/Resultat/gestionResultat.html.twig',array('resultat'=>$res));


    }
    public function detailResultatAction(Request $request,$idetudiant){


        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT n.notecc,n.etudiant,
             n.noteds, n.moyenne, n.noteexam,
             m.nom, m.coef,
             u.nomuser, u.prenomuser, u.classeetd,u.cinuser,u.email,u.numteluser
             FROM schoolBundle:Note n
             LEFT JOIN schoolBundle:Matier m
             WITH n.matiere = m.id
             LEFT JOIN schoolBundle:Users u
             WITH u.id = n.etudiant            
             WHERE n.etudiant = :etudiant'
        )->setParameter('etudiant',$idetudiant );

        $note = $query->getResult();

        $query2 = $entityManager->createQuery(
            'SELECT r.resultat
             FROM schoolBundle:Resultat r            
             WHERE r.etudiant = :etudiant'
        )->setParameter('etudiant',$idetudiant );

        $res = $query2->getResult();

        return $this->render('@evaluations/Resultat/detail.html.twig',
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


        $pieChart->getData()->setArrayToDataTable(
            [['Resussite','pourcentage de reussite'],
                ['Success',$succes],
            ['Failure',$echec]

                ]
        );
        $pieChart->getOptions()->setHeight(400);
        $pieChart->getOptions()->setWidth(600);
        $pieChart->getOptions()->setColors( [
            '#DF0174',
            '#1E126B',
            '#210B61'
        ]);




        return $this->render('@evaluations/Resultat/statistique.html.twig', array(
            'piechart' => $pieChart,
            ));
    }

    public function statistiqueUserAction()
    {
        $pieChartUser = new PieChart();
        $em= $this->getDoctrine();
        $res = $em->getRepository(Users::class)->findAll();
        $class = $em->getRepository(Classe::class)->findAll();
        $club = $em->getRepository(Club::class)->findAll();
        $totalUsers=count($res);
        $nbClass=count($class);
        $nbclub=count($club);

        $nbEnseignant=0;
        $nbPersonnel=0;
        $nbAdministrateur=0;
        $nbEtudiant=0;

        for($j=0;$j<count($res);$j++)
        { $tab=$res[$j]->getRoles();
            // dump($res[$j]->getRoles());

            if ($tab['0'] == 'ROLE_ETUDIANT') {
                $nbEtudiant += 1;
            } else if ($tab['0'] == 'ROLE_ADMIN'){
                $nbAdministrateur += 1;
            } else if ($tab['0'] == 'ROLE_PERSONNEL'){
                $nbPersonnel += 1;
            }else {$nbEnseignant +=1;}
        }


        $pieChartUser->getData()->setArrayToDataTable(
            [['Nombre Etudiant','Nombre Administrateur'],
                ['Nombre Etudiant',$nbEtudiant*100/$totalUsers],
                ['Nombre Enseignant',$nbEnseignant*100/$totalUsers],
                ['Nombre Personnel',$nbPersonnel*100/$totalUsers],
                ['Nombre Administrateur',$nbAdministrateur*100/$totalUsers],

            ]
        );
        $pieChartUser->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChartUser->getOptions()->getTitleTextStyle()->setColor('#009905');
        $pieChartUser->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChartUser->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChartUser->getOptions()->getTitleTextStyle()->setFontSize(40);
        $pieChartUser->getOptions()->setHeight(400);
        $pieChartUser->getOptions()->setWidth(600);
        $pieChartUser->getOptions()->setColors( [

            '#210B61',
            '#DF0174',
            '#0080FF',
            '#DF7401'

        ]);
        $em= $this->getDoctrine();
        $res = $em->getRepository(Resultat::class)->findAll();
        $totalEtudiant=count($res);

        $succes=0;
        $echec=0;
        for($j=0;$j<count($res);$j++)
        {

            if ($res[$j]->getResultat() >= 10) {
                $succes += 1;
            } else {
                $echec += 1;
            }
        }

        return $this->render('@User/User/statistique.html.twig', array(

            'piechartUser' => $pieChartUser,
            'nbuser'=>$totalUsers,
            'nbcls'=>$nbClass,
            'nbclub'=>$nbclub,
            'succes'=>$succes,
            'echec'=>$echec,
            'sp'=>$succes*100/$totalEtudiant,
            'es'=>$echec*100/$totalEtudiant

        ));
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

    public function deleteAllAction()
    {

        $repository = $this->getDoctrine()->getRepository(Resultat::class);
        $res = $repository->findAll();
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($res as $r){
        $entityManager->remove($r);
        $entityManager->flush();
    }
        return $this->redirectToRoute('resultat__management');
    }



    public function exportAction($idetudiant)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT n.notecc,n.noteds,n.moyenne,n.noteexam,m.nom,n.etudiant,
             m.coef,u.nomuser,u.prenomuser,u.classeetd
             FROM schoolBundle:Note n LEFT JOIN schoolBundle:Matier m
             WITH n.matiere = m.id
             LEFT JOIN schoolBundle:Users u WITH u.id = n.etudiant            
             WHERE n.etudiant = :etudiant'
        )->setParameter('etudiant',$idetudiant);

        $info = $query->getResult();
      /*  $em = $this->getDoctrine()->getManager();
        $resultat = $em->getRepository(Resultat::class)->findAll();*/

        $writer = $this->container->get('egyg33k.csv.writer');
        $csv = $writer::createFromFileObject(new \SplTempFileObject());
        $etudiant='Nom  '.$info['0']['nomuser'].' '.$info['0']['prenomuser'];

        $csv->insertOne($etudiant);
        $csv->insertOne('Classe    '.$info['0']['classeetd']);
        $csv->insertOne('Matieres                                    ');
        for($j=0;$j<count($info);$j++){

            $csv->insertOne('Coefficient :    '.$info[$j]['coef']);
            $csv->insertOne('Nom :    '.$info[$j]['nom']);
            $csv->insertOne('Note DS :    '.$info[$j]['noteds']);
            $csv->insertOne('Note CC:    '.$info[$j]['notecc']);
            $csv->insertOne('Note Exam :    '.$info[$j]['noteexam']);
            $csv->insertOne('Moyenne :    '.$info[$j]['moyenne']);

        }
        $csv->output('Resultat.csv');
        exit;
    }


}
