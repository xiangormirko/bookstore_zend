<?php

class BooksController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		/* default to the view action */
		$this->_redirect('/books/view');
		//$this->_helper->redirector('view');		
    }

    public function viewAction()
    {
        $book = new Application_Model_BookMapper();
        $this->view->books = $book->fetchAll();


    }

    public function insertAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Book();
		
		if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $book = new Application_Model_Book($form->getValues());
                $mapper  = new Application_Model_BookMapper();
                $mapper->save($book);
                return $this->_helper->redirector('view');
            }
        }

        $this->view->form = $form;
    }

    public function editAction()
    {
        $request = $this->getRequest();
		$id = $request->getParam("id");

        $form    = new Application_Form_Book();

        $book    = new Application_Model_Book();
		$mapper  = new Application_Model_BookMapper();
        $mapper->find($id, $book);
//		$this->view->book = $book;
		
		$form->populate($book);
		
		$this->view->form=$form;

    }

    public function detailAction()
    {
        $request = $this->getRequest();
		$id = $request->getParam("id");
        
        $book    = new Application_Model_Book();
		$mapper  = new Application_Model_BookMapper();
        $mapper->find($id, $book);
		$this->view->book = $book;
		
    }

    public function ajaxAction()
    {

        $db = new Zend_Db_Adapter_Pdo_Mysql(array(
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'bookstore'
        ));
        // action body
        $request = $this->getRequest();
        $title = $request->getParam("keyword");


        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();

        $sql = "SELECT * FROM items WHERE name LIKE ?";
        $key ='%' . $title . '%';

        $result = $db->fetchAll($sql, $key);

        $this->view->books = $result;

        echo json_encode($result);
//        return $this->view->render('books/ajax.phtml');

    }

    public function ajaxtableAction()
    {
        // action body
        $db = new Zend_Db_Adapter_Pdo_Mysql(array(
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'bookstore'
        ));
        // action body
        $request = $this->getRequest();
        $title = $request->getParam("keyword");


//        $this->_helper->viewRenderer->setNoRender(true);
//        $this->_helper->getHelper('layout')->disableLayout();
//        $this->view->addScriptPath(APPLICATION_PATH . '/layouts/scripts/');

        $sql = "SELECT * FROM items WHERE name LIKE ?";
        $key ='%' . $title . '%';

        $result = $db->fetchAll($sql, $key);


        $this->view->books = $result;
//        print_r($result);
//
//        $html = $this->view->render('/books/ajaxtable.phtml');
//        print_r($html);
//
//        return $html;
    }


}






