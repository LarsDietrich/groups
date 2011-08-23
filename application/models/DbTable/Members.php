<?php

class Application_Model_DbTable_Members extends Zend_Db_Table_Abstract
{

    protected $_name = 'members';
    protected $_primary = "id";
    
    public function get_primary() {
        return $this->_primary;
    }

}

