<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        //some encoding here
        return json_encode($object);
    }

    protected function objectDeserialize($text){
        // some decoding here
        return json_decode($text);
    }


    /**
     * @Route("/register", name="apiRegister")
     */
    public function apiRegisterAction(Request $request)
    {
        return new Response("<h2>Hii</h2>");
    }






}
