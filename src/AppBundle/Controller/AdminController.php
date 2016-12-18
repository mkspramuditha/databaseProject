<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class AdminController extends DefaultController
{

    /**
     * @Route("admin/dashboard", name="adminDashboard")
     */

    public function adminDashboardAction(Request $request){
        $user = $this->getUser();

        return $this->render('default/adminDashboard.html.twig',array(
            'user'=>$user
        ));

    }
}
