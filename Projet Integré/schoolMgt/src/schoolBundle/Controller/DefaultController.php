<?php

namespace schoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $snappy = $this->get('knp_snappy.pdf');

        $html = $this->renderView('', array(
            //..Send some data to your view if you need to //
        ));

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }

    public function mapAction()
    {
        return $this->render('@school/Default/map.html.twig', array(
            // ...
        ));

    }
}
