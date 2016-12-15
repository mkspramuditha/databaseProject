<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use AppBundle\Orm\DatabaseHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\VarDumper\Cloner\Data;

class DefaultController extends Controller
{
    /**
     * @Route("/login", name="adminLogin")
     */
    public function loginAction(Request $request)
    {

        $auth_checker = $this->get('security.authorization_checker');


        $token = $this->get('security.token_storage')->getToken();

        $user = $token->getUser();

        $myUser = new Users();
        $myUser->setId(1);
        $myUser->setUsername('mkspramuditha');
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($myUser,'mks');
        $myUser->setPassword($encoded);
        $myUser->setEmail('pramuditha.14@cse.mrt.ac.lk');
        $this->db()->delete($myUser);


        $isRoleAdmin = $auth_checker->isGranted('ROLE_ADMIN');
        if($isRoleAdmin)
        {
            return $this->redirect(
                $this->generateUrl("adminDashboard")
            );
        }


        $authenticationUtils = $this->get('security.authentication_utils');

        $error =$authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUserName();
        return $this->render('default/adminLogin.html.twig',array(
            'last_username' =>$lastUsername,
            'error'=>$error
        ));

    }

    /**
     * @Route("/dashboard", name="adminDashboard")
     */
    public function dashboardAction(Request $request)
    {
        var_dump('dashboard');
        exit;
    }

    public function db(){
        return DatabaseHandler::getInstance();
    }
}
