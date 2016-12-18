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

    public function adminDashboardAction(Request $request)
    {
        $user = $this->getUser();

        return $this->render('default/adminDashboard.html.twig', array(
            'user' => $user
        ));

    }

    /**
     * @Route("admin/users", name="adminUsers")
     */

    public function adminUsersAction(Request $request)
    {
        $user = $this->getUser();

        return $this->render('default/adminUsers.html.twig', array(
            'user' => $user
        ));

    }

    /**
     * @Route("admin/insights", name="adminInsights")
     */

    public function adminInsightsAction(Request $request)
    {
        $user = $this->getUser();

        return $this->render('default/adminInsights.html.twig', array(
            'user' => $user
        ));

    }

    /**
     * @Route("admin/settings", name="adminSettings")
     */

    public function adminSettingsAction(Request $request)
    {
        $user = $this->getUser();

        return $this->render('default/adminSettings.html.twig', array(
            'user' => $user
        ));

    }


}
