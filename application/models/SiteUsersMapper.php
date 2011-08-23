<?php

class Application_Model_SiteUsersMapper extends Application_Model_RowMapperAbstract
{
    public function __construct() {
        parent::__construct("Application_Model_DbTable_Siteusers", "Application_Model_SiteUsers");
    }
    
}

