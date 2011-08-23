<?php

class Application_Model_RSVPMapper extends Application_Model_RowMapperAbstract
{
    public function __construct() {
        parent::__construct("Application_Model_DbTable_RSVP","Application_Model_RSVP");
    }

}

