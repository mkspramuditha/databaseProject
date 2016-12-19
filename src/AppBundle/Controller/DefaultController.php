<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DiseaseData;
use AppBundle\Entity\EntryDetails;
use AppBundle\Entity\Location;
use AppBundle\Entity\Roles;

use AppBundle\Entity\Status;
use AppBundle\Entity\UserDetails;
use AppBundle\Entity\Users;
use AppBundle\Orm\DatabaseHandler;
use AppBundle\Repository\DiseaseDataRepository;
use AppBundle\Repository\EntryDetailsRepository;
use AppBundle\Repository\LocationRepository;
use AppBundle\Repository\RolesRepository;
use AppBundle\Repository\StatusRepository;
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


//        $user = new Users();
//        $user->setId(4321);
//        $user->setUsername('nipunasudha');
//        $user->setPassword('324fsd43');
//        $user->setEmail('nipuna.sudha@gmail.com');
//        $user->setRoles('ROLE_ADMIN');
//        $user->setStatus('K');
//        $user->setToken('3244ij4h23ji4h24gh23u4ghu');
//
//        $this->db()->update($user);



//        $status = StatusRepository::getInstance()->findBy(array('id'),array(8));


        //================================================================================================

        $isRoleAdmin = $auth_checker->isGranted('ROLE_ADMIN');
        if ($isRoleAdmin) {
            return $this->redirect(
                $this->generateUrl("adminDashboard")
            );
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();
//        var_dump($error);
        $lastUsername = $authenticationUtils->getLastUserName();
        return $this->render('default/adminLogin.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error
        ));

    }

    /**
     * @Route("/dashboard", name="adminDashboard1")
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

    public function getUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }
}
