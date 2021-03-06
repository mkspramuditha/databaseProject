<?php

namespace AppBundle\Controller;


use AppBundle\Repository\DiseaseDataRepository;

use AppBundle\Repository\UserDetailsRepository;
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
        $userCount = count(UsersRepository::getInstance()->findAll());
        $totalEntries = count(DiseaseDataRepository::getInstance()->findAll());
        $approves = count(UsersRepository::getInstance()->findBy(array('statusId'),array('STATUS_PENDING')));

//        var_dump($userCount);
//        var_dump($totalEntries);
//        exit;
        $title = 'dashboard';
        $user = $this->getUser();
        $recentData = DiseaseDataRepository::getInstance()->findAll('datetime');
//        exit;
//        print_r($recentData);
        return $this->render('default/adminDashboard.html.twig', array(
            'userCount'=>$userCount,
            'user' => $user,
            'recentData'=>$recentData,
            'title'=>$title,
            'totalEntries'=>$totalEntries,
            'unapprovedCount'=>$approves

        ));

    }

    /**
     * @Route("admin/users", name="adminUsers")
     */

    public function adminUsersAction(Request $request)
    {
        $email = $request->get('email');
        $username = $request->get('username');
        $firstName = $request->get('firstName');
        $phoneNo = $request->get('phoneNo');


        $userList = UsersRepository::getInstance()->findLike($username,$firstName,$email);

        $title = 'users';
        $user = $this->getUser();
//        $userList = UsersRepository::getInstance()->findBy(array('users.username'),array('shan'));

        return $this->render('default/adminUsers.html.twig', array(
            'user' => $user,
            'userList'=>$userList,
            'title'=>$title,
            'email'=>$email,
            'username'=>$username,
            'firstName'=>$firstName,
            'phoneNo'=>$phoneNo,
            'users'=>$userList
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
        $title = 'settings';
        $user = $this->getUser();

        return $this->render('default/adminSettings.html.twig', array(
            'user' => $user,
            'title'=>$title
        ));

    }


    /**
     * @Route("admin/approve", name="adminApprove")
     */

    public function adminApproveAction(Request $request)
    {
        $approveId = $request->get('id');
//        var_dump($approveId);
        if($approveId != null and $approveId !== ""){
            $user = UsersRepository::getInstance()->findOneBy(array('users.id'),array($approveId));
            $user->setStatus('STATUS_ACTIVE');
            $this->db()->update($user);
        }
        $title = 'approve';

        $approves = UsersRepository::getInstance()->findBy(array('statusId'),array('STATUS_PENDING'));
        $user = $this->getUser();

        return $this->render('default/adminApprove.html.twig', array(
            'user' => $user,
            'title'=>$title,
            'approves'=>$approves
        ));

    }


    /**
     * @Route("/test", name="test")
     */

    public function testAction(Request $request)
    {
        exit;

    }


}
