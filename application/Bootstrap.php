<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _dateInit(){
        date_default_timezone_set("Eire");
    }
        
}

