<?php

namespace ForumBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Doctrine\ORM\EntityManagerInterface;
use ForumBundle\Entity\Question;
use ForumBundle\ForumBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use ForumBundle\Entity\Reponse;
use ForumBundle\Form\TagType;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Paginator;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
class AdminController extends Controller
{

    /**
     * @Route("/admin/add/tag", name="add_tag")
     * @Security("has_role('ROLE_PERSONNEL')")
     */
    public function addTagAction(Request $request, ObjectManager $em)
    {
        $add_tag_form = $this->createForm(TagType::class);
        $add_tag_form->handleRequest($request);

        if ($add_tag_form->isSubmitted() && $add_tag_form->isValid()) {

            $tag = $add_tag_form->getData();
            $em->persist($tag);
            $em->flush();

            $this->addFlash('success', 'Tag created');
            return $this->redirectToRoute('view_tags');
        }

        return $this->render('ForumBundle::admin/add_tag.html.twig', [
            'add_tag_form' => $add_tag_form->createView(),
        ]);
    }



    public function validAnswerAction(Reponse $answer)
    {$user = $this->getUser();
        if ($user->hasRole('ROLE_PERSONNEL')) {

$em=$this->getDoctrine()->getManager();
            if ($answer->isValid() == 1) {
                $answer->setValid(false);
                $em->flush();

                $this->addFlash('info', 'Answer disabled');
            } else {
                $answer->setValid(true);
                $em->flush();

                $this->addFlash('info', 'Answer enabled');
            }

            return $this->redirectToRoute('answers_listing_admin');
        }else
        {
            return $this->redirectToRoute('fos_user_security_login');
        }

    }


    public function answersListingAdminAction(Request $request)
    {$user = $this->getUser();
        $filter=array("red","yellow","green","blue");
        if ($user->hasRole('ROLE_PERSONNEL'))
        {



        $em=$this->getDoctrine()->getManager();
        $dql = "SELECT a FROM ForumBundle:Reponse a ORDER BY a.created_at ASC";

        $pagination = $em->createQuery($dql)->getResult();


            foreach ($pagination as $i){
                if ($i->getBody()) {

                    foreach ($filter as $var){
                        $i->setBody(str_replace($var, "*****", $i->getBody()));
                    }}
            }
        return $this->render('ForumBundle::admin/answers_listing_admin.html.twig', [
            'pagination' => $pagination
        ]);
    }else
        {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
public function opensAction($id){

    $em = $this->getDoctrine()->getManager();
    $event = $em->getRepository("ForumBundle:Question")
        ->find($id);
    $event->setOpen(true);

        $em->persist($event);
        $em->flush();

    return $this->redirectToRoute('view_question',['id'=>$id]);

}
    public function closesAction($id){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("ForumBundle:Question")
            ->find($id);
        $event->setOpen(false);

        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('view_question',['id'=>$id]);

    }
    public function banUserAction($id){

        $em = $this->getDoctrine()->getManager();
        $usr = $em->getRepository("schoolBundle:users")
            ->findBy(array("username"=>$id));
        foreach ($usr as $x){
            $enb = $x->setEnabled(false);

            $em->persist($x);}
        $em->flush();
        return $this->redirectToRoute('answers_listing_admin');
    }
    public function chartPieAction(Request $request)
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $Asso = $em->getRepository(Question::class)->findAll();
        $data= array();
        $stat=['Les Réponses', 'Nombre des Réponse Per Question'];
        array_push($data,$stat);
        foreach ($Asso as $b){
            $x=$em->getRepository(Reponse::class)->findFF($b->getIdQuestion());
            //   var_dump($x);
            $stat=array();
            foreach ($x as $i) {
                foreach ($i as $o) {
                    $p = $o + 0;

                    array_push($stat, $b->getTitle(), $p);//$classe->get());
                    $stat = [$b->getTitle(), $p];
                    array_push($data, $stat);

                }
            }
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Nombre Reponse / Question');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@Forum\admin\stat.html.twig', array('piechart' => $pieChart));

    }
    public function unbanUserAction($id){

        $em = $this->getDoctrine()->getManager();
        $usr = $em->getRepository("schoolBundle:users")
            ->find($id);


        $usr->setEnabled(true);

        $em->persist($usr);
        $em->flush();
        return $this->redirectToRoute('answers_listing_admin');
    }
}
