<?php

class Application_Model_GroupsMapper extends Application_Model_RowMapperAbstract
{

    public function __construct() {
        parent::__construct('Application_Model_DbTable_Groups', 'Application_Model_Groups');
    }
}

