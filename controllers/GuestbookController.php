<?php

class GuestbookController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $guestbook = new Application_Model_GuestbookMapper();
        $this->view->entries = $guestbook->fetchAll();
    }

    public function signAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Guestbook();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Guestbook($form->getValues());
                $mapper  = new Application_Model_GuestbookMapper();
                $mapper->save($model);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }

    public function findAction()
    {
        $request = $this->getRequest();
        $email = $request->getParam('id');
        $guestb = new Application_Model_DbTable_Guestbook();


        $comments = $guestb->findByEmail($email);



        $this->view->email = $email;
        $this->view->comments= $comments;

    }


}





