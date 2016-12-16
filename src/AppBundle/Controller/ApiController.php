<?php

namespace AppBundle\Controller;


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

    protected function isAPIAuthenticated($user){

    }


    /**
     * @Route("/register", name="apiRegister")
     */
    public function apiRegisterAction(Request $request)
    {
        $requestObject = $request->get('obj');
        $register = $this->objectDeserialize($requestObject);
        return new Response($register->id);
    }


    /**
     * @Route("/login", name="apiLogin")
     */
    public function apiLoginAction(Request $request)
    {
        $requestObject = $request->get('obj');
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

}
