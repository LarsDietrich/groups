<?php

class Application_Model_DbTable_Events extends Zend_Db_Table_Abstract
{

    protected $_name = 'events';
    protected $_primary = "id";

    public function get_primary() {
        return $this->_primary;
    }



}

