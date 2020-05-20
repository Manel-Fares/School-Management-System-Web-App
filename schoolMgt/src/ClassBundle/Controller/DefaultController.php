<?php

namespace ClassBundle\Controller;

use ClassBundle\Entity\Classeenseignantmatiere;
use ClassBundle\Entity\Enseigner;
use Dompdf\Dompdf;
use Swift_Attachment;
use Swift_Mailer;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use schoolBundle\Entity\Classe;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ClassBundle:Default:index.html.twig');
    }
    public function affetudiclassAction()
{
    $em=$this->getDoctrine()->getManager();
    $etdds=$em->getRepository('schoolBundle:Users')->findByRole("ROLE_ETUDIANT");
    $classe=$em->getRepository('schoolBundle:Classe')->findAll();


    return $this->render('ClassBundle:Default:affetudiclass.html.twig',array(
        'etds'=>$etdds,
        'classe'=>$classe

    ));
}

    public function affenseigclassAction()
    {
        $em=$this->getDoctrine()->getManager();

        $classe=$em->getRepository('schoolBundle:Classe')->findAll();
        $matiereUser=$em->getRepository('ClassBundle:Enseigner')->findAll();


        return $this->render('ClassBundle:Default:affenseignclass.html.twig',array(
            'matiereUser'=>$matiereUser,
            'classe'=>$classe

        ));
    }
    public function affectAction(Request $request,$id)
    {
        $transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername('velov638@gmail.com')
            ->setPassword('Velo123456789.');

        $mailer = Swift_Mailer::newInstance($transporter);
        $em=$this->getDoctrine()->getManager();



if($request->isMethod('post')){
    $idd=$request->get('data')+0;
        $classe=$em->getRepository('schoolBundle:Classe')->find($idd);

    $user=$em->getRepository('schoolBundle:Users')->find($id+0);

$sujet="you are assigned successfully to the class : ".$classe->getName();

$emploie=$em->getRepository('ClassBundle:Emplois')->findBy(array('nameclas'=>$classe));
    $path = $this->getParameter('brochures_directory').'/'.($emploie[0]->getSource());
    var_dump($path);
    $message = (new \Swift_Message('Hello Email'))
        ->setFrom('velov638@gmail.com')
        ->setTo($user->getEmail())
        ->setBody($sujet)
    ;
    if(!empty($emploie)){
        $sujet.="and here is your TimeTable :";
    $message->attach(
        Swift_Attachment::fromPath($path)
    );}
    $mailer->send($message);



    $user->setClasseetd($classe);
$em->persist($user);
$em->flush();
}
        return $this->redirectToRoute("affectEtudClass");
    }

    public function affectEnseiAction(Request $request,$id,$idmat)
    {
        $transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername('velov638@gmail.com')
            ->setPassword('Velo123456789.');
        $mailer = Swift_Mailer::newInstance($transporter);
        $em=$this->getDoctrine()->getManager();



if($request->isMethod('post')){
    $idd=$request->get('data')+0;

        $classe=$em->getRepository('schoolBundle:Classe')->find($idd);

    $user=$em->getRepository('ClassBundle:Enseigner')->findOneBy(array('idenseignant'=>$id+0));
    $mat=$em->getRepository('ClassBundle:Enseigner')->findOneBy(array('idmatiere'=>$idmat+0));

$sujet="you are assigned successfully to the class : ".$classe->getName()." and with subject ".$mat->getIdmatiere()->getNom() ;


    $message = (new \Swift_Message('Hello Email'))
        ->setFrom('velov638@gmail.com')
        ->setTo($user->getIdenseignant()->getEmail())
        ->setBody($sujet)
    ;

    $mailer->send($message);

$x=new Classeenseignantmatiere($user,$mat,$classe);

$em->persist($x);
$em->flush();
}

       return $this->redirectToRoute("affctens");
    }


    public function getAbsenceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $absences = $em->getRepository('ClassBundle:Absence')->findBy(array('idUser'=>$user));
$cnt=count($absences);
        return $this->render('ClassBundle:Default:absenceetud.html.twig', array(
            'absences' => $absences,'countou'=>$cnt
        ));
    }

    public function liveSearchAction(Request $request)
    {
        $requestString = $request->get('q');
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('ClassBundle:Absence')->Search($requestString);
        /*$serializer = new Serializer([new ObjectNormalizer()]);
           $formatted = $serializer->normalize($produits);*/
        var_dump($produits);
        if(!$produits) {
            $absences = $em->getRepository('ClassBundle:Absence')->findBy(array('idUser'=>$user));
            $result['entities']=$this->getRealEntities($absences);
        } else {
            $result['entities'] = $this->getRealEntities($produits);
        }

        return new Response(json_encode($result));

    }
    public function getRealEntities($entities){

        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = $entity->getId();
            $realEntities[$entity->getDate()] = $entity->getDate();
            $realEntities[$entity->getTimedeb()] = $entity->getTimedeb();
            $realEntities[$entity->getTimefin()] = $entity->getTimefin();
            $realEntities[$entity->getIdMatiere()->getNom()] = $entity->getIdMatiere()->getNom();

        }

        return $realEntities;
    }


    public function getEmploisAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $Userr = $em->getRepository('schoolBundle:Users')->findBy(array('id'=>$user));

        foreach ($Userr as $u)
        $class=$u->getClasseetd();

        $emploie=$em->getRepository('ClassBundle:Emplois')->findBy(array('nameclas'=>$class));
        //$path = $this->getParameter('brochures_directory').'/'.($emploie[0]->getSource());
        $path = $emploie[0]->getSource();
        $r=$path;

        return $this->render('ClassBundle:Default:getEmplois.html.twig', array(
            'pathh' => $r
        ));
    }
    public function indexPdfAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projets = $em->getRepository('ClassBundle:Calendarannuel')->findAll();


        return $this->render('Calendarannuel/indexPdf.html.twig', array(
            'projets' => $projets,
        ));
    }
    public function PDFAction()
    {
        $em=$this->getDoctrine()->getManager();
        $projets = $em->getRepository('ClassBundle:Calendarannuel')->findAll();
        $dompdf = new Dompdf();
        $html = $this->renderView('Calendarannuel/indexPdf.html.twig', array(
            'projets' => $projets,

        ));
        $dompdf->loadHtml($html);
        $dompdf->set_option('defaultFont', 'Courier');
        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream();
        return $this->redirectToRoute('calend_index');

    }
}
