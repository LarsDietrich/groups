<?php

class Application_Model_DbTable_RSVP extends Zend_Db_Table_Abstract
{

    protected $_name = 'rsvps';
    protected $_primary = "id";
    
    public function get_primary() {
        return $this->_primary;
    }

}

