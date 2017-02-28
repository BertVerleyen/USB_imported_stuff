<?php

class Application_Model_DbTable_Guestbook extends Zend_Db_Table_Abstract
{

    protected $_name = 'guestbook';

    public function findByEmail($email)
    {

        $result = $this->select()->where('email =?',$email);
        $comments = $this->fetchAll($result);





            return $comments;




    }
}

