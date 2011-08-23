<?php

class Application_Model_VenuesMapper extends Application_Model_RowMapperAbstract
{

    public function __construct() {
        parent::__construct("Application_Model_DbTable_Venues", "Application_Model_Venues");
    }
}

