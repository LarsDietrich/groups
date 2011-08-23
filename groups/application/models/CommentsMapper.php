<?php

class Application_Model_CommentsMapper extends Application_Model_RowMapperAbstract
{
        public function __construct() {
            parent::__construct('Application_Model_DbTable_Comments', 'Application_Model_Comments');
        }
    
}

