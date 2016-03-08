<?php

class AuthenticationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function signupAction()
    {
        $db = $this->_getParam('db');

        $loginForm = new Application_Form_Login();

        if ($loginForm->isValid($_POST)) {

            $adapter = new Zend_Auth_Adapter_DbTable(
                $db,
                'members',
                'member_login',
                'member_password',
                'first_name',
                'last_name',
                'email',
                'birthday'
            );

            $adapter->setMemberLogin($loginForm->getValue('member_login'));
            $adapter->setMemberPassword($loginForm->getValue('member_password'));
            $adapter->setFirstName($loginForm->getValue('first_name'));
            $adapter->setLastName($loginForm->getValue('last_name'));
            $adapter->setEmail($loginForm->getValue('email'));
            $adapter->setBirthday($loginForm->getValue('birthday'));

            $auth   = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);

            if ($result->isValid()) {
                $this->_helper->FlashMessenger('Successful Login');
                $this->_redirect('/');
                return;
            }

        }

        $this->view->form = $loginForm;

    }

    public function loginAction()
    {
        $db = $this->_getParam('db');

        $loginForm = new Application_Form_Login();


        if ($loginForm->isValid($_POST)) {

            $adapter = new Zend_Auth_Adapter_DbTable(
                $db,
                'members',
                'member_login',
                'member_password'
            );

            $adapter->setIdentity($loginForm->getValue('member_login'));
            $adapter->setCredential($loginForm->getValue('member_password'));

            $auth   = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);

            if ($result->isValid()) {
                $this->_helper->FlashMessenger('Successful Login');
                $this->_redirect('/');
                return;
            }

        }

        $this->view->form = $loginForm;

    }

    public function logoutAction()
    {
        // action body
    }

    public function editAction()
    {
        // action body
    }


}









