<?php

namespace AppBundle\Controller;


use AppBundle\Entity\DiseaseData;
use AppBundle\Entity\UserDetails;
use AppBundle\Entity\Users;
use AppBundle\Orm\DatabaseHandler;
use AppBundle\Repository\DiseaseDataRepository;
use AppBundle\Repository\UserDetailsRepository;
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
        $phone      = $register->phone;
        $role       = $register->role;
//        $token      = md5($username+rand(0,1000));
        $message    ="";

        if($this->isUserExists($username,$email)){
            $obj = new \stdClass();
            $obj->status = false;
//            $obj->token = $token;
            $obj->message = "Username or email exists";

            return $this->apiSendResponse($obj);
        }
        $user = new Users();
        $user->setUsername($username);

        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $password);
        $user->setPassword($encoded);
        $user->setEmail($email);
        $user->setRoles($role);
        $user->setToken("");
//        $user->setToken($token);
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
//        $obj->token = $token;
        $obj->message = $message;

        return $this->apiSendResponse($obj);
    }


    /**
     * @Route("/login", name="apiLogin")
     */
    public function apiLoginAction(Request $request)
    {
        $requestObject = $request->get('data');

        $login = $this->objectDeserialize($requestObject);

        $username = $login->username;
        $password = $login->password;

        $obj = new \stdClass();

        if(!$this->isUserExists($username)){
            $obj->error = true;
            $obj->errorMsg = "User does not exists";
            $obj->token = null;
            $obj->user = null;
            $obj->data = null;

            return $this->apiSendResponse($obj);
        }

        $user = UsersRepository::getInstance()->findOneBy(array('username'),array('shan'));
        if($this->isAuthenticated($user,$password)){
            $obj->error = false;
            $obj->errorMsg = "login success";
            $objUser = new \stdClass();
            $objUser->username = $user->getUsername();
            $objUser->password = $password;
            $objUser->email = $user->getEmail();

            $token = md5($username+rand(0,1000));

            $obj->tokn = $token;

            $userObject = UsersRepository::getInstance()->findOneBy(array('username'),array($username));
            $userObject->setToken($token);
            $this->db()->update($userObject);

            $userDetails = UserDetailsRepository::getInstance()->findOneBy(array('userId'),array($username));

            $objUser->firstName = $userDetails->getFirstname();
            $objUser->middleName = $userDetails->getLastname();
            $objUser->middleName = $userDetails->getMiddlename();
            $objUser->phone     = $userDetails->getPhone();

            $obj->user = $objUser;

            $dataArray = [];
            $userData = DiseaseDataRepository::getInstance()->findBy(array('userId'),array($username));
            foreach ($userData as $data){
                $temp = new \stdClass();
                $temp->diseaseDataId = $data->getDiseasedataid();
                $temp->sysmptoms = $data->getSymptoms();
                $temp->description = $data->getDescription();
                $temp->victimCount = $data->getVictimcount();
                $temp->locationCode = $data->getLocationcode();
                $temp->entryId = $data->getEntryid();
                $dataArray[] = $temp;
            }

            $obj->data = $dataArray;

            return $this->apiSendResponse($obj);


        }

        $obj->error = true;
        $obj->errorMsg = "Password does not match !";
        $obj->token = null;
        $obj->user = null;
        $obj->data = null;

        return $this->apiSendResponse($obj);

    }

    /**
     * @Route("/sync/up", name="apiSyncUp")
     */
    public function apiSyncUpAction(Request $request)
    {
        $requestObject = $request->get('data');
        $syncUp = $this->objectDeserialize($requestObject);
        $username = $syncUp->username;
        $token = $syncUp->token;
        $data = $syncUp->data;

        $user = UsersRepository::getInstance()->findOneBy(array('username','token'),array($username,$token));

        $obj = new \stdClass();

        if($user!= null){
            foreach ($data as $row){

                $disease = DiseaseDataRepository::getInstance()->findOneBy(array('entryId'),array($row->entryId));

                if($disease != null){
                    $diseaseData = $disease;


                    $diseaseData->setEntryid($row->entryId);
                    $diseaseData->setUserid($username);
                    $diseaseData->setSymptoms($row->symptoms);
                    $diseaseData->setDescription($row->description);
                    $diseaseData->setVictimcount($row->victimCount);
                    $diseaseData->setLocationcode($row->locationCode);
                    $this->db()->update($diseaseData);
                }
                else{
                    $diseaseData = new DiseaseData();

                    $diseaseData->setEntryid($row->entryId);
                    $diseaseData->setUserid($username);
                    $diseaseData->setSymptoms($row->symptoms);
                    $diseaseData->setDescription($row->description);
                    $diseaseData->setVictimcount($row->victimCount);
                    $diseaseData->setLocationcode($row->locationCode);
                    $this->db()->insert($diseaseData);

                }

            }

            $obj->error = false;
            $obj->errorMsg = "Sync Up was successful";


            return $this->apiSendResponse($obj);

        }

        $obj->error = true;
        $obj->errorMsg = "Invalid authentication details";

        return $this->apiSendResponse($obj);
    }

    /**
     * @Route("/sync/down", name="apiSyncDown")
     */
    public function apiSyncDownAction(Request $request)
    {



    }

    public function isUserExists($username, $email=""){
        $query = "SELECT * FROM users WHERE username = '". $username . "' OR email = '" .$email. "' ";
        $instance = DatabaseHandler::getInstance();
        $results = $instance->query($query);
        $instance->setResult($results);
        if(!$instance->fetch()){
            return false;
        }

        return true;
    }

    public function isAuthenticated($user,$password){

        if(is_null($user)==false){
            $encoder = $this->container->get('security.password_encoder');
//            $encodedPsw = $encoder->encodePassword($user, $password);
//            var_dump($encodedPsw);
//            var_dump($user->getPassword());
//            var_dump($encoder->isPasswordValid($user,$password));
//            if($user->getPassword() == $encodedPsw){
//                return true;
//            }
            return $encoder->isPasswordValid($user,$password);
        }
        return false;

    }
}
