<?php

class Application_Model_DbTable_Invites extends Zend_Db_Table_Abstract
{

    protected $_name = 'invites';
    protected $_primary = "id";

    public function get_primary() {
        return $this->_primary;
    }
}

