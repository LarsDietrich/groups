<?php

class Application_Model_DbTable_Venues extends Zend_Db_Table_Abstract
{

    protected $_name = 'venues';
    protected $_primary = "id";

    public function get_primary() {
        return $this->_primary;
    }

}

