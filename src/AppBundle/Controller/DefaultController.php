<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DiseaseData;
use AppBundle\Entity\EntryDetails;
use AppBundle\Entity\Users;
use AppBundle\Orm\DatabaseHandler;
use AppBundle\Repository\DiseaseDataRepository;
use AppBundle\Repository\EntryDetailsRepository;
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
//        $entry = new EntryDetails();
//        $entry->setId(6);
//        $entry->setEntryid('entry02');
//        $entry->setDatetime('2016-11-11 12:24:18');
//        $this->db()->update($entry);



//
//        $disease = EntryDetailsRepository::getInstance()->findBy(array('entryid'),array('entry02'));
//

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
