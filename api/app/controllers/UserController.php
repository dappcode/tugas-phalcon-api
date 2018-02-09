<?php

class UserController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function userAction()
    {
        $user = new User();
        $json_data = $user->getDataUser();
        die(json_encode($json_data));
    }

}

