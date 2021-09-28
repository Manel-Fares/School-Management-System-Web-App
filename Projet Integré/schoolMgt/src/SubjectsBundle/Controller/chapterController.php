<?php

namespace SubjectsBundle\Controller;

use schoolBundle\Entity\Matier;
use SubjectsBundle\Entity\Chapters;
use SubjectsBundle\Form\ChaptersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class chapterController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $chapitres = $em->getRepository('SubjectsBundle:Chapters')->findAll();

        return $this->render('chapitre/index.html.twig', array(
            'chapitres' => $chapitres,
        ));
    }
    public function addchAction(Request $request,$id)
    {
        $chap = new Chapters();
        $form = $this->createForm(ChaptersType::class, $chap);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $chap->setMatier($em->getRepository(Matier::class)->find($id));
            $chapterFile = $form->get('fichier')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($chapterFile) {
                $originalFilename = pathinfo($chapterFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $chapterFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $chapterFile->move(
                        $this->getParameter('chapters_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $chap->setFichier($newFilename);
            }
            $em->persist($chap);
            $em->flush();

            return $this->redirectToRoute('Chapitre_affich_ens',array('id'=>$id));
        }

        return $this->render("@Subjects/chapitre/add.html.twig", array(
            'form' => $form->createView()
        ));
    }

    public function affichensAction($id){
        $em = $this->getDoctrine()->getManager();
        $chap = $em->getRepository(Chapters::class)->findByMatier($id);
        return $this->render('@Subjects/chapitre/listchres.html.twig',array('chapitre'=>$chap));
    }
    public function affichAction($id){
        $em = $this->getDoctrine()->getManager();
        $chap = $em->getRepository(Chapters::class)->findByMatier($id);
        return $this->render('@Subjects/chapitre/listch.html.twig',array('chapitre'=>$chap));
    }
    public function affichadminAction($id){
        $em = $this->getDoctrine()->getManager();
        $chap = $em->getRepository(Chapters::class)->findByMatier($id);
        return $this->render('@Subjects/chapitre/listchadmin.html.twig',array('chapitre'=>$chap));
    }
    public function suppchAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $chap=$em->getRepository(Chapters::class)->find($id);
        $em->remove($chap);
        $em->flush();
        return $this->redirectToRoute('Chapitre_affich');
    }

}
