<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initDate(){
        date_default_timezone_set("Eire");
    }
    
    protected function _initRoutes(){
    
        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();
        
        $route = new Zend_Controller_Router_Route('/join', array("controller"=>"siteuser"));
        $router->addRoute("join",$route);
    }
    
    protected function _initRegisteryValues()
    {
        Zend_Registry::set("counties", array("antrim","armagh","carlow","cavan","clare",
        "cork","derry","donegal","down","dublin","fermanagh",
        "galway","kerry","kildare","kilkenny","laois","leitrim",
        "limerick","longford","louth","mayo","meath","monaghan","offaly","roscommon",
        "sligo","tipperary","tyrone","waterford","westmeath","wexford","wicklow"));
        
        $session = new Zend_Session_Namespace("user");
        Zend_Registry::set("user_session", $session);
    }
    
    
    
        
}

