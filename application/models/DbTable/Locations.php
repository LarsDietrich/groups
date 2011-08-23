<?php

class Application_Model_DbTable_Locations extends Zend_Db_Table_Abstract
{

    protected $_name = 'locations';
    protected $_primary = "id";

    public function get_primary() {
        return $this->_primary;
    }
}

