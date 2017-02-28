<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $albums = new Application_Model_DbTable_Song();
        $this->view->albums = $albums->fetchAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Song();
        $form->submit->setLabel('Add');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Song();
                $albums->addAlbum($artist, $title);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction()
    {
        $form = new Application_Form_Song();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Song();
                $albums->updateAlbum($id, $artist, $title);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);//$this->getRequest()->getParam('id');
            if ($id > 0) {
                $albums = new Application_Model_DbTable_Song();
                $form->populate($albums->getAlbum($id));
            }
        }
    }

    public function deleteAction()
    {

        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');//form input name
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');//form acction id
                $albums = new Application_Model_DbTable_Song();
                $albums->deleteAlbum($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $albums = new Application_Model_DbTable_Song();
            $this->view->album = $albums->getAlbum($id);
        }
    }


}







