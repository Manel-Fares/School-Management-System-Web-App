<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use schoolBundle\Entity\Users;
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
    public function statistiqueUserAction()
    {
        $pieChartUser = new PieChart();
        $em= $this->getDoctrine();
        $res = $em->getRepository(Users::class)->findAll();
        $totalUsers=count($res);

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

        $nbEnseignant=$nbEnseignant*100/$totalUsers;
        $nbPersonnel=$nbPersonnel*100/$totalUsers;
        $nbEtudiant=$nbEtudiant*100/$totalUsers;
        $nbAdministrateur=$nbAdministrateur*100/$totalUsers;


        $pieChartUser->getData()->setArrayToDataTable(
            [['Nombre Etudiant','Nombre Administrateur'],
                ['Nombre Etudiant',$nbEtudiant],
                ['Nombre Enseignant',$nbEnseignant],
                ['Nombre Personnel',$nbPersonnel],
                ['Nombre Administrateur',$nbAdministrateur],

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

        return $this->render('@user/User/statistique.html.twig', array(

            'piechartUser' => $pieChartUser,
            'nbetud'=>$nbEtudiant,
            'nbens'=>$nbEnseignant,
            'nbadmin'=>$nbAdministrateur,
            'nbpers'=>$nbPersonnel));
    }

}
