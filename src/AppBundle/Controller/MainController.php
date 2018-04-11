<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class MainController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }
}