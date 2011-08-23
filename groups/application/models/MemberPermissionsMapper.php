<?php

class Application_Model_MemberPermissionsMapper extends Application_Model_RowMapperAbstract
{

    public function __construct() {
        parent::__construct('Application_Model_DbTable_MemberPermissions', 'Application_Model_MemberPermissions');
    }
}

