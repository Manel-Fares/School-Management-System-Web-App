<?php

namespace evaluationsBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\PieChart\PieSlice;
use Jhg\NexmoBundle\JhgNexmoBundle;
use schoolBundle\Entity\Classe;
use EvenementBundle\Entity\Club;
use schoolBundle\Entity\Resultat;
use schoolBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PhpOffice\PhpWord\Style\Image;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;



/**
 * Resultat controller.
 *
 */
class ResultatController extends Controller
{
    public function transcriptAction($idetudiant)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT n
             FROM schoolBundle:Note n         
             WHERE n.etudiant = :etudiant'
        )->setParameter('etudiant',$idetudiant);

        $note= $query->getResult();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $imagesFolder = $this->get('kernel')->getRootDir() . '/../web/images/';
        $image = $imagesFolder.'esprit.jpg';
        $image2 = $imagesFolder.'tampon.png';
        $text='Trascript';

        //Absolute positioning
        $section->addTextBreak(3);
        $section->addText($text,array(
            'size' => 22,
            'bold' => true,
            'color' => '#8B0000',
            'underline'=>'single'));
        $section->addImage(
            $image,
            array(
                'width'            => Converter::cmToPixel(3),
                'height'           => Converter::cmToPixel(3),
                'positioning'      => Image::POSITION_ABSOLUTE,
                'posHorizontal'    => Image::POSITION_HORIZONTAL_RIGHT,
                'posHorizontalRel' => Image::POSITION_RELATIVE_TO_MARGIN,
                'posVerticalRel'   => Image::POSITION_RELATIVE_TO_MARGIN,
                'marginLeft'       => Converter::cmToPixel(15.5),
                'marginTop'        => Converter::cmToPixel(1.55),
            )
        );

        $section->addLine(['weight' => 1, 'width' => 500, 'height' => 0]);
        $section->addText('Full Name:    '.$note[0]->getEtudiant()->getNomuser().'  '.$note[0]->getEtudiant()->getPrenomuser());
        $section->addText('N°CIN:    '.$note[0]->getEtudiant()->getcinuser());
        $section->addText('Class:    '.$note[0]->getEtudiant()->getClasseetd()->getName());
        $section->addLine(['weight' => 1, 'width' => 500, 'height' => 0]);

        $table = $section->addTable();
        for($j=0;$j<count($note);$j++){
            $table->addRow();
                $table->addCell(2000)->addText($note[$j]->getMatiere()->getNom());
            $table->addRow();
                $table->addCell(1000);
                $table->addCell(2000)->addText('Coefficient:');
                $table->addCell(2000)->addText($note[$j]->getMatiere()->getCoef());
            $table->addRow();
                $table->addCell(1000);
                $table->addCell(2000)->addText('CD Grade:');
                $table->addCell(2000)->addText( $note[$j]->getNoteds());
            $table->addRow();
                $table->addCell(1000);
                $table->addCell(2000)->addText('CC Grade:');
                $table->addCell(2000)->addText($note[$j]->getNotecc());
            $table->addRow();
                $table->addCell(1000);
                $table->addCell(2000)->addText('Exam Grade:');
                $table->addCell(2000)->addText($note[$j]->getNoteexam());
            $table->addRow();
                $table->addCell(1000);
                $table->addCell(2000)->addText('Score:');
                $table->addCell(2000)->addText($note[$j]->getMoyenne());
        }

        $table->addCell(1750)->ddTextBreak(1);

        $section->addImage(
            $image2,
            array(
                'width'            => Converter::cmToPixel(3),
                'height'           => Converter::cmToPixel(3),
                'posHorizontal'    => Image::POSITION_HORIZONTAL_LEFT,
                'posHorizontalRel' => Image::POSITION_RELATIVE_TO_MARGIN,
                'posVerticalRel'   => Image::POSITION_RELATIVE_TO_PAGE,
                'marginLeft'       => Converter::cmToPixel(15.5),
                'marginTop'        => Converter::cmToPixel(1.55),
            )
        );

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        $filePath = 'word/'.$note[0]->getEtudiant()->getNomuser().' '.$note[0]->getEtudiant()->getPrenomuser().md5(uniqid()) . '.docx';
        // Write file into path
        $objWriter->save($filePath);
        $this->addFlash('success', 'Transcript downloaded');


        return $this->render('@evaluations/Note/affichageNoteEtudiant.html.twig',array('note'=>$note));



    }


    public function indexAction(){
        $resultat= $this->getDoctrine()->getRepository(Resultat::class)->findAll();
        return $this->render("@evaluations/Resultat/read.html.twig",array("resultat"=>$resultat));
    }

    public function calculerAction(){
        $entityManager = $this->getDoctrine()->getManager();
        $liste=$entityManager
            ->createQuery("SELECT distinct u
            FROM schoolBundle:Users u
            where u.roles like :role")
            ->setParameter('role', '%"'.'ROLE_ETUDIANT'.'"%');
        ;

        $listeEtudiant = $liste->getResult();

        for($j=0;$j<count($listeEtudiant);$j++)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $query = $entityManager->createQuery(
                'SELECT n FROM schoolBundle:Note n                
                 WHERE n.etudiant = :etudiant'
            )->setParameter('etudiant',$listeEtudiant[$j]);
            $listeNote = $query->getResult();

            $sumcCoef=0;  $sumMoy=0;
            for($i=0;$i<count($listeNote);$i++) {
                if($listeNote[$i]){
                $sumcCoef += $listeNote[$i]->getMatiere()->getCoef();
                $sumMoy += $listeNote[$i]->getMoyenne()*$listeNote[$i]->getMatiere()->getCoef();}
            }
            $resultat = new Resultat();
            $resultat->setEtudiant($listeEtudiant[$j]);
            $date = new \DateTime('now', new \DateTimeZone('Asia/Kolkata'));
            $date->format('yy-m-d');
            $resultat->setDateresultat($date);
            if($sumcCoef){
            $resultat->setResultat($sumMoy/$sumcCoef);}
            else $resultat->setResultat(0);
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
        $em=$this->getDoctrine()->getManager();

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT n
             FROM schoolBundle:Note n         
             WHERE n.etudiant = :etudiant'
        )->setParameter('etudiant',$this->getUser()->getID()  );

        $note = $query->getResult();

        $query2 = $entityManager->createQuery(
            'SELECT r.resultat ,r.dateresultat 
             FROM schoolBundle:Resultat r            
             WHERE r.etudiant = :etudiant'
        )->setParameter('etudiant',$this->getUser()->getID()  );

        $res = $query2->getResult();
        dump($res);
        return $this->render('@evaluations/Resultat/affichageResultatEtudiant.html.twig',
            array('note'=>$note,'resultat'=>$res));
    }

    public function  sendSMSAction()
    {
        return $this->render('@school/Default/test.html.twig');

    }

    public function gererResultatsAction(){

        $resultat= $this->getDoctrine()->getRepository(Resultat::class)->findAll();


        return $this->render('@evaluations/Resultat/gestionResultat.html.twig',array('resultat'=>$resultat));


    }
    public function detailResultatAction(Request $request,$idetudiant){


        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT n
             
             FROM schoolBundle:Note n
                        
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
            } else if ($tab['0'] == 'ROLE_ADMINISTRATEUR'){
                $nbAdministrateur += 1;
            } else if ($tab['0'] == 'ROLE_PERSONNEL'){
                $nbPersonnel += 1;
            }else {$nbEnseignant +=1;}
        }


        $pieChartUser->getData()->setArrayToDataTable(
            [['User','Pourcentage'],
                ['Students Number',$nbEtudiant*100/$totalUsers],
                ['Teacher Number',$nbEnseignant*100/$totalUsers],
                ['Staff Number',$nbPersonnel*100/$totalUsers],
                ['Administrator Number',$nbAdministrateur*100/$totalUsers],

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
        $res1 = $em->getRepository(Resultat::class)->findAll();
        $level1 = $em->getRepository(Classe::class)->findBy(['niveau' => '1']);
        $level2 = $em->getRepository(Classe::class)->findBy(['niveau' => '2']);
        $level3 = $em->getRepository(Classe::class)->findBy(['niveau' => '3']);
        $level4 = $em->getRepository(Classe::class)->findBy(['niveau' => '4']);
        $level5 = $em->getRepository(Classe::class)->findBy(['niveau' => '5']);




        $Columnchart = new \CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart();
        $Columnchart->getData()->setArrayToDataTable([
            ['Levels', 'Classes'],
            ['level 1', count($level1)],
            ['level 2', count($level2)],
            ['level 3', count($level3)],
            ['level 4', count($level4)],
            ['level 5', count($level5)]

        ]);

        $Columnchart->getOptions()->getChart()
            ->setTitle('Classes per level');
        $Columnchart->getOptions()
            ->setBars('vertical')
            ->setHeight(400)
            ->setWidth(400)
            ->setColors(['#0080FF', '#210B61'])
            ->getVAxis()
            ->setFormat('decimal');

        $res3 = $em->getRepository(Resultat::class)->findAll();
        $totalEtudiant=count($res3);

        $succes=0;
        $echec=0;
        for($j=0;$j<count($res3);$j++)
        {

            if ($res3[$j]->getResultat() >= 10) {
                $succes += 1;
            } else {
                $echec += 1;
            }
        }
        $succes=$succes*100/$totalEtudiant;
        $echec=$echec*100/$totalEtudiant;

        $pieChartr = new PieChart();
        $pieChartr->getData()->setArrayToDataTable(
            [
                ['Sucess', 'Percentage'],
                ['Succes', $succes ],
                ['', $echec]
            ]
        );


        $pieSlice1 = new PieSlice();
        $pieSlice1->setColor('#210B61');
        $pieSlice2 = new PieSlice();
        $pieSlice2->setColor('transparent');
        $pieChartr->getOptions()->setSlices([$pieSlice1, $pieSlice2]);
        $pieChartr->getOptions()->setHeight(140);
        $pieChartr->getOptions()->setWidth(300);

        return $this->render('@User/User/statistique.html.twig', array(
            'Columnchart' =>$Columnchart,
            'piechartUser' => $pieChartUser,
            'piechartr' => $pieChartr,
            'nbuser'=>$totalUsers,
            'nbcls'=>$nbClass,
            'nbclub'=>$nbclub,
            'nb'=>count($level5),

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
            'SELECT n
             FROM schoolBundle:Note n         
             WHERE n.etudiant = :etudiant'
        )->setParameter('etudiant',$idetudiant);

        $info = $query->getResult();
        /*  $em = $this->getDoctrine()->getManager();
          $resultat = $em->getRepository(Resultat::class)->findAll();*/


        $writer = $this->container->get('egyg33k.csv.writer');
        $csv = $writer::createFromFileObject(new \SplTempFileObject());
        $csv->setDelimiter(';');


            $csv->insertOne('First Name' . ';' . 'Last Name' .';'. 'Class');
            $csv->insertOne($info['0']->getEtudiant()->getPrenomuser() . ';' .
                $info['0']->getEtudiant()->getNomuser() .';'.
                $info['0']->getEtudiant()->getClasseetd()->getName());

            $csv->insertOne('');

            $csv->insertOne('Subject' . ';' . 'Coefficient' .';'. 'CC Grade' . ';' . 'CD Grade' . ';' . 'Exam Grade' . ';' . 'Score'.';');
        for($j=0;$j<count($info);$j++) {

            $csv->insertOne($info[$j]->getMatiere()->getNom() . ';' .
                $info[$j]->getMatiere()->getCoef() . ';' .
                $info[$j]->getNoteds() . ';' .
                $info[$j]->getNotecc() . ';' .
                $info[$j]->getNoteexam() . ';' .
                $info[$j]->getMoyenne());
        }
        $csv->output('Resultat.csv');
        exit;
    }


}
