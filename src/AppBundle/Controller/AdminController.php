<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class AdminController extends DefaultController
{

    /**
     * @Route("/test", name="test")
     */

    public function adminDashboardAction(Request $request){

        return $this->render('baseBackend.html.twig');

    }
}
