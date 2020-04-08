<?php

namespace schoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $snappy = $this->get("knp_snappy.pdf");
        $filename = "resultat";
        $weburl = "";
        return new response();

    }
}
