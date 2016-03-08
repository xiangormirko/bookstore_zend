<?php

class Zend_View_Helper_LoggedInAs extends Zend_View_Helper_Abstract
{
public function loggedInAs ()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $username = $auth->getIdentity()->member_login;
            $logoutUrl = $this->view->url(array('controller'=>'Authentication',
                'action'=>'logout'), null, true);

            return '<p class="welcome"> Welcome ' . $username .'</p>'. '. <a class="logout" href="'.$logoutUrl.'">Logout</a>';

//            return '<p class="welcome"> Welcome ' . $username . '. </p><a class= "logout" href="'.$logoutUrl.'">Logout</a>';
        }

    $request = Zend_Controller_Front::getInstance()->getRequest();
    $controller = $request->getControllerName();
    $action = $request->getActionName();


    }
    }