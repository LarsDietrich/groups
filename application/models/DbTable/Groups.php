<?php

class Application_Model_DbTable_Groups extends Zend_Db_Table_Abstract
{

    protected $_name = 'groups';
    protected $_primary = "id";

    public function get_primary() {
        return $this->_primary;
    }
}

