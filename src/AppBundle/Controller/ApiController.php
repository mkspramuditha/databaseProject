<?php

namespace AppBundle\Controller;


use AppBundle\Entity\UserDetails;
use AppBundle\Entity\Users;
use AppBundle\Orm\DatabaseHandler;
use AppBundle\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * @Route("/api")
 */

class ApiController extends DefaultController
{

    protected function apiSendResponse($object){
        $response =  new Response($this->objectSerialize($object));
        $responseHeaders = $response->headers;
        $responseHeaders->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $responseHeaders->set('Access-Control-Allow-Origin', '*');
        $responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        return $response;
    }

    protected function objectSerialize($object){

        return json_encode($object);
    }

    protected function objectDeserialize($text){

        return json_decode($text);
    }

    protected function isAPIAuthenticated($username , $token){
        $user = UsersRepository::getInstance()->findOneBy(array('username','token'),array($username,$token));
        if($user == null){
            return false;
        }
        return true;
    }


    /**
     * @Route("/register", name="apiRegister")
     */
    public function apiRegisterAction(Request $request)
    {
//        $test = new \stdClass();
//        $test->username = "shan";
//        $test->password = "shan";
//        $test->email = "shan";
//        $test->firstName = "shan";
//        $test->middleName = "shan";
//        $test->lastName = "shan";
//        $test->role = "ROLE_ADMIN";
//
//        var_dump($this->objectSerialize($test));

        $requestObject = $request->get('data');
        $register   = $this->objectDeserialize($requestObject);
        $username   = $register->username;
        $password   = $register->password;
        $email      = $register->email;
        $firstName  = $register->firstName;
        $middleName = $register->middleName;
        $lastName   = $register->lastName;
        $phone      = $register->lastName;
        $role       = $register->role;
        $token      = md5($username+rand(0,1000));
        $message    ="";
        $user = new Users();
        $user->setUsername($username);

        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $password);
        $user->setPassword($encoded);
        $user->setEmail($email);
        $user->setRoles($role);
        $user->setToken($token);
        if($role == "ROLE_DOCTOR" or $role == "ROLE_HEALTH_OFFICER"){
            $user->setStatus("STATUS_PENDING");
            $message = "Pending for admin approval";

        }
        else{
            $user->setStatus("STATUS_ACTIVE");
            $message = "Registration Successful";
        }



        $this->db()->insert($user);

        $userDetails = new UserDetails();
        $userDetails->setUserid($username);
        $userDetails->setFirstname($firstName);
        $userDetails->setMiddlename($middleName);
        $userDetails->setLastname($lastName);
        $userDetails->setPhone($phone);
        $userDetails->setEmail($email);

        $this->db()->insert($userDetails);

        $obj = new \stdClass();
        $obj->status = true;
        $obj->token = $token;
        $obj->message = $message;

        return $this->apiSendResponse($obj);
    }


    /**
     * @Route("/login", name="apiLogin")
     */
    public function apiLoginAction(Request $request)
    {
        $requestObject = $request->get('data');

        $register = $this->objectDeserialize($requestObject);
        return new Response($register->id);
    }

    /**
     * @Route("/sync/up", name="apiSyncUp")
     */
    public function apiSyncUpAction(Request $request)
    {
        $requestObject = $request->get('obj');
        $register = $this->objectDeserialize($requestObject);
        return new Response($register->id);
    }

    /**
     * @Route("/sync/down", name="apiSyncDown")
     */
    public function apiSyncDownAction(Request $request)
    {
        $requestObject = $request->get('obj');
        $register = $this->objectDeserialize($requestObject);
        return new Response($register->id);
    }

    public function isUserExists($username, $email){
        $query = "SELECT FROM users WHERE username = ". $username . " OR email = " .$email. " ";
        $instance = DatabaseHandler::getInstance();
        $results = $instance->query($query);
        $instance->setResult($results);
        if(!$instance->fetch()){
            return true;
        }
        return true;


    }
}
