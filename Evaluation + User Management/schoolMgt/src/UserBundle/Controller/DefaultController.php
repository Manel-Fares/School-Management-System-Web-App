<?php

namespace UserBundle\Controller;

use FOS\RestBundle\Tests\Fixtures\User;
use schoolBundle\Entity\Matier;
use schoolBundle\Entity\mobile;
use schoolBundle\Entity\Note;
use schoolBundle\Entity\Resultat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EvenementBundle\Entity\Rate;
use EvenementBundle\Entity\Participation;
use EvenementBundle\Entity\Demandeevenement;
use EvenementBundle\Entity\Evenement;

use EvenementBundle\Entity\Club;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use schoolBundle\Entity\Users;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }

    /*
     * Calcul Resultat mobile
     */
    public function calculerResAction(){
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
        $res = $this->getDoctrine()->getManager()->getRepository(Resultat::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($res);
        return new JsonResponse($formatted);
    }
/*
 * affichage Resultat mobile
 */
    public function allResultatAction()
    {
        $user = $this->getDoctrine()->getManager()->getRepository(Resultat::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);


        return new JsonResponse($formatted);
    }



/*
 * affichage des notes relatives a un etudiant mobile
 */
    public function noteEtudiantAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT n
             FROM schoolBundle:Note n           
             WHERE n.etudiant = :etudiant'
        )->setParameter('etudiant',$id);

        $note = $query->getResult();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($note);
        return new JsonResponse($formatted);
    }

    /*
     * affichage des notes relatives a un etudiant mobile
     */
    public function noteEnseigantAction($idM,$idC,$idE)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT n
             FROM schoolBundle:Note n 
             join schoolBundle:Users u
             WHERE n.matiere = :matiere
             AND u.classeetd = :classe
             AND n.enseignant = :enseignant'
        )->setParameters(array(
            'matiere'=>$idM,
            'classe'=>$idC,
            'enseignant'=>$idE)
    );

        $note = $query->getResult();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($note);
        return new JsonResponse($formatted);
    }

    /*
     * liste utilisateurs mobile
     */
    public function alluserAction()
    {
        $user = $this->getDoctrine()->getManager()->getRepository('schoolBundle:Users')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);


        return new JsonResponse($formatted);
    }

    /*
     * login mobile
     */

    public function loginAction($username,$password)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT u
             FROM schoolBundle:Users u        
             WHERE u.username = :username
             AND u.password like :password'

        )->setParameters(array(
            'username'=>$username,
            'password'=>$password.'%')
        );

        $user = $query->getResult();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }
    /*
     * recuperation mot de passe mobile
     */
    public function forgetPasswordAction($username)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT u
             FROM schoolBundle:Users u        
             WHERE u.username = :username'

        )->setParameter(
                'username',$username
        );

        $user = $query->getResult();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }
    /*
     * liste classes enseignant mobile
     */
    public function listeClassesAction($id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT u
             FROM ClassBundle:Classeenseignantmatiere u        
             WHERE u.idUser= :id '


        )->setParameter(
            'id',$id
        );
        $rep = $query->getResult();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($rep);
        return new JsonResponse($formatted);
    }
    /*
    * liste matiere enseignant mobile
    */
    public function listeMatieresAction($idE,$idC)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT u
             FROM ClassBundle:Classeenseignantmatiere u        
             WHERE u.idUser= :id 
             AND u.idClass= :idc'

        )->setParameters(array(
                'id'=>$idE,
                'idc'=>$idC)
        );



        $rep = $query->getResult();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($rep);
        return new JsonResponse($formatted);
    }

    /*
    * liste etudiant selon classe mobile
    */
    public function listeEtudiantAction($idC)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT distinct u
             FROM schoolBundle:Users u
             where u.roles like :role
             AND u.classeetd= :id'

        )->setParameters(array(
                'id'=>$idC,
                'role'=>'%"'.'ROLE_ETUDIANT'.'"%')
        );


        $rep = $query->getResult();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($rep);
        return new JsonResponse($formatted);
    }

/*
 * Supprimer User mobile
 */
    public function deleteAction($username)
    {

        $repository = $this->getDoctrine()->getRepository(Users::class);
        $u = $repository->findOneBy([
            'username' => $username,

        ]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($u);
        $entityManager->flush();

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT u
             FROM schoolBundle:Users u
             WHERE u.username = :username'

        )->setParameter('username',$username);
        $user = $query->getResult();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }
    /*
     * supprimer tous les resultat
     */
    public function deleteResAction()
    {

        $repository = $this->getDoctrine()->getRepository(Resultat::class);
        $res = $repository->findAll();
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($res as $r){
            $entityManager->remove($r);
            $entityManager->flush();
        }



        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($res);
        return new JsonResponse($formatted);
    }

    /*
     * Mobile chart
     */


    public function statUserAction()
    {

        $em = $this->getDoctrine();
        $res = $em->getRepository(Users::class)->findAll();


        $nbEnseignant = 0;
        $nbPersonnel = 0;
        $nbAdministrateur = 0;
        $nbEtudiant = 0;

        for ($j = 0; $j < count($res); $j++) {
            $tab = $res[$j]->getRoles();
            // dump($res[$j]->getRoles());

            if ($tab['0'] == 'ROLE_ETUDIANT') {
                $nbEtudiant += 1;
            } else if ($tab['0'] == 'ROLE_ADMINISTRATEUR') {
                $nbAdministrateur += 1;
            } else if ($tab['0'] == 'ROLE_PERSONNEL') {
                $nbPersonnel += 1;
            } else {
                $nbEnseignant += 1;
            }
        }


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize(array(

            'admin' => $nbAdministrateur,
            'etudiant' => $nbEtudiant,
            'enseignant' => $nbEnseignant,
            'personnel' => $nbPersonnel));
        return new JsonResponse($formatted);
    }
    /*
     * Ajouter notes mobile
     */
    public function addnoteAction($ens,$etd,$m,$cc,$ds,$exam)
    { $note = new Note();

        $entityManager = $this->getDoctrine()->getManager();

        $liste=$entityManager->createQuery(
            "SELECT  u
            FROM schoolBundle:Users u
            where u.id = :id")
            ->setParameter('id', $etd);
        ;
        $listemat=$entityManager->createQuery(
            "SELECT  m
            FROM schoolBundle:Matier m
            where m.id = :id")
            ->setParameter('id', $m);
        ;

        $listeEns=$entityManager->createQuery(
            "SELECT  u
            FROM schoolBundle:Users u
            where u.id = :id")
            ->setParameter('id', $ens);
        ;

        $listeEtudiant = $liste->getResult();
        $listeMatiere = $listemat->getResult();
        $listeEnseigant = $listeEns->getResult();


        $note->setEtudiant($listeEtudiant[0]);
        $note->setEnseignant($listeEnseigant[0]);
        $note->setMatiere($listeMatiere[0]);


            $date = new \DateTime('now', new \DateTimeZone('Asia/Kolkata'));
            $date->format('yy-m-d');

            $note->setDatenote($date);
            $note->setNoteexam($exam*1.0);
            $note->setNoteds($ds*1.0);
            $note->setNotecc($cc*1.0);
            $moyenne=$note->getNotecc()*0.2+$note->getNoteds()*0.3+$note->getNoteexam()*0.5;
            $note->setMoyenne($moyenne);

        $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($note);
        return new JsonResponse($formatted);


        }
    public function modifnAction($idetudiant,$idmatiere,$idenseignant,$cc,$ds,$exam)
    {
            $em = $this->getDoctrine()->getManager();
            $note = $em->getRepository(Note::class)->findOneBy([
                'etudiant' => $idetudiant*1,
                'matiere' => $idmatiere*1,
                'enseignant' => $idenseignant*1
            ]);

            $note->setNoteds($ds*1.0);
            $note->setNotecc($cc*1.0);
            $note->setNoteexam($exam*1.0);
            $moyenne=$note->getNotecc()*0.2+$note->getNoteds()*0.3+$note->getNoteexam()*0.5;
            $note->setMoyenne($moyenne);


            $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($note);
        return new JsonResponse($formatted);


    }


    /*resultat etudiant */
    public function ResultatEtdAction($id)
    {   $liste = $this->getDoctrine()->getManager()->createQuery(
        "SELECT  r
            FROM schoolBundle:Resultat r
            where r.etudiant = :id")
        ->setParameter('id', $id);
        ;
        $user = $liste->getResult();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);


        return new JsonResponse($formatted);
    }
    /*
******************************* omar *****************************/
    public function allClubAction()
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
    public function addRatingAction($rating,$idc,$idu)
    {
        $em = $this->getDoctrine()->getManager();
        $Rate = new Rate();;
        $rateuser=$em->getRepository('EvenementBundle:Rate')->findOneBy(array('iduser'=>$idu));

        // $rateuser=$em->getRepository('EvenementBundle:Rate')->find($idu);
        $user=$em->getRepository('schoolBundle:Users')->find($idu);
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
    public function demandeEventAction($dd,$df,$b,$idc,$desc,$pic)
    {
        $em = $this->getDoctrine()->getManager();
        $demande = new Demandeevenement();
        //  var_dump($idc);
        $d=new \DateTime($dd);
        $f=new \DateTime($df);
        // $club=$em->getRepository('EvenementBundle:Club')->find($idc);
        $club=$em->getRepository('EvenementBundle:Club')->findOneBy(array('nomclub'=>$idc));

        $demande->setEtat("non valider");
        $demande->setDescription($desc);
        $demande->setImage($pic);
        $demande->setIdclub($club);
        $demande->setDatefin($f);
        $demande->setDatedebut($d);
        $demande->setBudget($b);



        $em->persist($demande);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($demande);
        return new JsonResponse($formatted);
    }
    public function DemandespecifiqueAction($idu)
    { $aa = array();
        $em = $this->getDoctrine()->getManager();
        $club=$em->getRepository('EvenementBundle:Club')->findBy(array('idresponsable'=>$idu));

        $demande=$em->getRepository('EvenementBundle:Demandeevenement')->findBy(array('idclub'=>$club));

        foreach ($demande as $r){
            $evs=$r;
            array_push($aa,$evs);

        }
        for($i=0;$i<count($aa);$i++)
        {
            $aa[$i]->setDatefin($aa[$i]->getDatefin()->format('Y-m-d')) ;
            $aa[$i]->setDatedebut($aa[$i]->getDatedebut()->format('Y-m-d')) ;
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($aa);
        return new JsonResponse($formatted);
    }
    public function deleteMobileAction($id)

    { $em = $this->getDoctrine()->getManager();

        $demandeevenement=$em->getRepository('EvenementBundle:Demandeevenement')->find($id);
        $em->remove($demandeevenement);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($demandeevenement);
        return new JsonResponse($formatted);
    }
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


    public function addParticipationAction($ide,$idu)
    {
        $em = $this->getDoctrine()->getManager();
        $Part = new Participation();
        $Parateuser=$em->getRepository('EvenementBundle:Participation')->findOneBy(array('iduser'=>$idu));
        $user=$em->getRepository('schoolBundle:Users')->find($idu);
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
        $evenements = array();
        $em = $this->getDoctrine()->getManager();

        $evenement = $em->getRepository('EvenementBundle:Evenement')->afficerSpecifique();
        // var_dump($evenement);
        for($i=0;$i<count($evenement);$i++){
            //   var_dump($evenements[$i]['idevenement']);
            $p = $em->getRepository('EvenementBundle:Participation')->partEvclbtop5($evenement[$i]['idevenement']);
            foreach ($p as $r){
                 array_push($evenements,$r);
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
