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
        $this->_redirect('/Authentication/login');
    }

    public function signupAction()
    {

        $form = new Application_Form_Signup();

        if ($form->isValid($_POST)) {
            $member = new Application_Model_Member();
            $mapper = new Application_Model_MemberMapper();
            $member->setMemberLogin($form->getValue('member_login'));
            $member->setMemberPassword($form->getValue('member_password'));
            $member->setFirstName($form->getValue('first_name'));
            $member->setLastName($form->getValue('last_name'));
            $member->setEmail($form->getValue('email'));
            $member->setBirthday($form->getValue('birthday'));
            $mapper->save($member);

            return $this->_helper->redirector('index');
        }

        $this->view->form = $form;

    }

    public function loginAction()
    {

        // If we're already logged in, just redirect
        if(Zend_Auth::getInstance()->hasIdentity())
        {
            $this->_redirect('books');
        }

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
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('login'); // back to login page
    }

    /**
     *
     */
    public function editAction()
    {
        // action body
        $request = $this->getRequest();
        $id = $request->getParam("id");

        $form    = new Application_Form_Signup();

        $member  = new Application_Model_Member();
        $mapper  = new Application_Model_MemberMapper();
        $mapper->find($id, $member);
		$this->view->member = $member;


        $form->populate($member->toArray());

        $this->view->form=$form;
//        $request = $this->getRequest();
//        $id = $request->getParam("id");
//
//        $member    = new Application_Model_Member();
//        $mapper  = new Application_Model_MemberMapper();
//        $mapper->find($id, $member);
//        $this->view->member = $member;

}


}









