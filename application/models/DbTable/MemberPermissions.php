<?php

class Application_Model_DbTable_MemberPermissions extends Zend_Db_Table_Abstract
{

    protected $_name = 'memberpermissions';
    protected $_primary = "id";
    
    public function get_primary() {
        return $this->_primary;
    }


}

