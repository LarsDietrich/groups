<?php

class Application_Model_DbTable_Comments extends Zend_Db_Table_Abstract
{

    protected $_name = 'comments';
    protected $_primary = "id";
    
    public function get_primary() {
        return $this->_primary;
    }




}

