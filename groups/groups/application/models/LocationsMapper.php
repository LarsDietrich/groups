<?php

class Application_Model_LocationsMapper extends Application_Model_RowMapperAbstract
{
    public function __construct() {
        parent::__construct("Application_Model_DbTable_Locations", "Application_Model_Locations");
    }

}

