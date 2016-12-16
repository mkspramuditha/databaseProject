<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DiseaseData;
use AppBundle\Entity\Users;
use AppBundle\Orm\DatabaseHandler;
use AppBundle\Repository\DiseaseDataRepository;
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
//        $disease = new DiseaseData();
//        $disease->setId(1);
//        $disease->setUserid('shan');
//        $disease->setDiseasedataid('d01');
//        $disease->setSymptoms('puka ridenawa');
//        $disease->setDescription('thiyanawa');
//        $disease->setVictimcount(213);
//        $disease->setLocationcode('81000');
//        $disease->setEntryid('e01');
//        $this->db()->update($disease);
//


//
        $disease = DiseaseDataRepository::getInstance()->findOneBy(array('diseasedataid'),array('d01'));
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
