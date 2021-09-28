<?php

namespace evaluationsBundle\Controller;




use schoolBundle\Entity\Matier;
use schoolBundle\Entity\Note;
use schoolBundle\Entity\Users;
use evaluationsBundle\Form\NoteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Note controller.
 *
 */
class NoteController extends Controller
{
    /**
     * Lists all note entities.
     *
     */
    public function indexAction()
    {
        $notes= $this->getDoctrine()->getRepository(Note::class)->findAll();
        return $this->render("@evaluations/Note/read.html.twig",array("notes"=>$notes));
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository(Note::class)->findAll();
        $query = $em->createQuery(

        );
    }



    public function noteEtudiantAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT n
             FROM schoolBundle:Note n           
             WHERE n.etudiant = :etudiant'
        )->setParameter('etudiant',$this->getUser()->getID() );

        $note = $query->getResult();

        return $this->render('@evaluations/Note/affichageNoteEtudiant.html.twig',array('note'=>$note));
    }

    public function addAction(Request $request)
    {
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moyenne=$note->getNotecc()*0.2+$note->getNoteds()*0.3+$note->getNoteexam()*0.5;
            $note->getEtudiant($moyenne);
            $note->setMoyenne($moyenne);
            $note->setEnseignant($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

            return $this->redirectToRoute('note_affiche_enseignant');
        }

        return $this->render("@evaluations/Note/add.html.twig", array(
            'note' => $note,
            'form' => $form->createView(),
        ));
    }

    public function noteEnseignantAction(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT 
             n
             FROM schoolBundle:Note n        
             WHERE n.enseignant = :enseignant'

        )->setParameter('enseignant', $this->getUser()->getID()  );

        $note = $query->getResult();

        return $this->render('@evaluations/Note/affichageNoteEnseignant.html.twig',array(
            'note'=>$note
        ));
    }


    /**
     * Finds and displays a note entity.
     *
     */
    public function showAction(Note $note)
    {
        $deleteForm = $this->createDeleteForm($note);

        return $this->render('note/show.html.twig', array(
            'note' => $note,
            'delete_form' => $deleteForm->createView(),
        ));
    }




    /**
     * Displays a form to edit an existing note entity.
     *
     */
    public function editAction(Request $request,$idetudiant,$idmatiere)
    { $repository = $this->getDoctrine()->getRepository(Note::class);
        $note = $repository->findOneBy([
            'etudiant' => $idetudiant,
            'matiere' => $idmatiere
        ]);

        $form = $this->createFormBuilder($note)
            ->add('notecc',NumberType::class,[
                'label' => 'CC Grade',
                'attr' => [
                    'min' => 0,
                    'max' => 20
                ]
            ])
            ->add('noteds',NumberType::class,[
                'label' => 'CD Grade',
                'attr' => [
                    'min' => 0,
                    'max' => 20
                ]
            ])
            ->add('noteexam',NumberType::class,[
                'label' => 'Exam Grade',
                'attr' => [
                    'min' => 0,
                    'max' => 20
                ]
            ])


            ->add('Envoyer',SubmitType::class,[
                'label'=>'Save',
                'attr' => ['formnovalidate ' => 'formnovalidate'],
            ])->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cc = $form['notecc']->getData();
            $ds = $form['noteds']->getData();
            $exam = $form['noteexam']->getData();
            $em = $this->getDoctrine()->getManager();
            $note = $em->getRepository(Note::class)->findOneBy([
                'etudiant' => $idetudiant,
                'matiere' => $idmatiere
            ]);

            $note->setNoteds($ds);
            $note->setNotecc($cc);
            $note->setNoteexam($exam);
            $moyenne=$note->getNotecc()*0.2+$note->getNoteds()*0.3+$note->getNoteexam()*0.5;
            $note->setMoyenne($moyenne);


            $em->flush();

            return $this->redirectToRoute('note_affiche_enseignant');
        }

        return $this->render("@evaluations/Note/update.html.twig", array(
            'note' => $note,
            'form' => $form->createView(),
        ));


    }

    public function filtreAction(Request $request,$idetudiant,$idmatiere)
    { $repository = $this->getDoctrine()->getRepository(Note::class);
        $note = $repository->findOneBy([
            'etudiant' => $idetudiant,
            'matiere' => $idmatiere
        ]);

        $form = $this->createFormBuilder($note)
            ->add('notecc',NumberType::class,[
                'attr' => [
                    'min' => 0,
                    'max' => 20
                ]
            ])
            ->add('noteds',NumberType::class,[
                'attr' => [
                    'min' => 0,
                    'max' => 20
                ]
            ])
            ->add('noteexam',NumberType::class)

            ->add('Envoyer',SubmitType::class,[
                'attr' => ['formnovalidate ' => 'formnovalidate']
            ])->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cc = $form['notecc']->getData();
            $ds = $form['noteds']->getData();
            $exam = $form['noteexam']->getData();
            $em = $this->getDoctrine()->getManager();
            $note = $em->getRepository(Note::class)->findOneBy([
                'etudiant' => $idetudiant,
                'matiere' => $idmatiere
            ]);

            $note->setNoteds($ds);
            $note->setNotecc($cc);
            $note->setNoteexam($exam);
            $moyenne=$note->getNotecc()*0.2+$note->getNoteds()*0.3+$note->getNoteexam()*0.5;
            $note->setMoyenne($moyenne);


            $em->flush();

            return $this->redirectToRoute('note_affiche_enseignant');
        }

        return $this->render("@evaluations/Note/update.html.twig", array(
            'note' => $note,
            'form' => $form->createView(),
        ));


    }

    /**
     * Deletes a note entity.
     *
     */
    public function deleteAction($idetudiant,$idmatiere)
    {

        $repository = $this->getDoctrine()->getRepository(Note::class);
        $note = $repository->findOneBy([
            'etudiant' => $idetudiant,
            'matiere' => $idmatiere
        ]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($note);
        $entityManager->flush();
        return $this->redirectToRoute('note_affiche_enseignant');
    }


}
