<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Users;
use AppBundle\Orm\DatabaseHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $myUser->setUsername('ashan');
//        $encoder = $this->container->get('security.password_encoder');
//        $encoded = $encoder->encodePassword('ashan');
        $myUser->setPassword("ashan");
        $myUser->setEmail('ashan@gmail.com');
        DatabaseHandler::insert($myUser);



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
}
