<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DiseaseData;
use AppBundle\Entity\EntryDetails;
use AppBundle\Entity\Location;
use AppBundle\Entity\Roles;

use AppBundle\Entity\UserDetails;
use AppBundle\Entity\Users;
use AppBundle\Orm\DatabaseHandler;
use AppBundle\Repository\DiseaseDataRepository;
use AppBundle\Repository\EntryDetailsRepository;
use AppBundle\Repository\LocationRepository;
use AppBundle\Repository\RolesRepository;
use AppBundle\Repository\UserDetailsRepository;
use AppBundle\Repository\UsersRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Validator\Constraints\DateTime;
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
//============================================================================================

//
//        $userdetails = new UserDetails();
//        $userdetails->setId(5);
//        $userdetails->setUserid('shan');
//        $userdetails->setFirstname('shan');
//        $userdetails->setMiddlename('pramuditha');
//        $userdetails->setLastname('pathirana');
//        $userdetails->setPhone('4238947238');
//        $userdetails->setEmail('shan@shan');
//
//
//        $this->db()->update($userdetails);
//
//
//
//        $userdetails = UserDetailsRepository::getInstance()->findBy(array('firstname'),array('nananaa'));


        //================================================================================================
        $isRoleAdmin = $auth_checker->isGranted('ROLE_ADMIN');
        if ($isRoleAdmin) {
            return $this->redirect(
                $this->generateUrl("adminDashboard")
            );
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUserName();
        return $this->render('default/adminLogin.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error
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

    public function db()
    {
        return DatabaseHandler::getInstance();
    }
}
