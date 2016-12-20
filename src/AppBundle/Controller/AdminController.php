<?php

namespace AppBundle\Controller;


use AppBundle\Repository\DiseaseDataRepository;

use AppBundle\Repository\UsersRepository;
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
        $title = 'dashboard';
        $user = $this->getUser();
        $recentData = DiseaseDataRepository::getInstance()->findAll();
//        print_r($recentData);
        return $this->render('default/adminDashboard.html.twig', array(
            'user' => $user,
            'recentData'=>$recentData,
            'title'=>$title
        ));

    }

    /**
     * @Route("admin/users", name="adminUsers")
     */

    public function adminUsersAction(Request $request)
    {
        $title = 'users';
        $user = $this->getUser();
        $userList = UsersRepository::getInstance()->findBy(array('users.username'),array('shan'));

        return $this->render('default/adminUsers.html.twig', array(
            'user' => $user,
            'userList'=>$userList,
            'title'=>$title
        ));

    }

    /**
     * @Route("admin/insights", name="adminInsights")
     */

    public function adminInsightsAction(Request $request)
    {
        $title = 'insights';
        $user = $this->getUser();


//        $users = UsersRepository::getInstance()->findAll();

        return $this->render('default/adminDashboard.html.twig',array(
            'user'=>$user,
//            'users'=>$users
            'title'=>$title
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


    /**
     * @Route("/test", name="test")
     */

    public function testAction(Request $request)
    {
        $user = UsersRepository::getInstance()->findOneBy(array('username'),array('arunan1'));
//        var_dump($user->getId());
//        var_dump($user->getUsername());
//        $user = $this->getUser();
//
//        return $this->render('default/adminSettings.html.twig', array(
//            'user' => $user
//        ));

    }


}
