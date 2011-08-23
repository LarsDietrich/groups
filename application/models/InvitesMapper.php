<?php

class Application_Model_InvitesMapper extends Application_Model_RowMapperAbstract
{
    
    public function __construct() {
        parent::__construct('Application_Model_DbTable_Invites', 'Application_Model_Invites');
    }


}

