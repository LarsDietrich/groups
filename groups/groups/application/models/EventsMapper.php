<?php

class Application_Model_EventsMapper extends Application_Model_RowMapperAbstract
{
        
    public function __construct() {
        parent::__construct("Application_Model_DbTable_Events", "Application_Model_Events");
    }

}

