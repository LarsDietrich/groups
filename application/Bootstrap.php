<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initDate(){
        date_default_timezone_set("Eire");
    }
    
    protected function _initRoutes(){
    
        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();
        
        $route = new Zend_Controller_Router_Route('/join', array("controller"=>"siteuser","module"=>"default"));
        $router->addRoute("join",$route);
        
        /*
        $route = new Zend_Controller_Router_Route('/dashboard',array("controller"=>"dashboard"));
        $router->addRoute("dashboard",$route);

         */
        
        $route = new Zend_Controller_Router_Route('/signin',array("controller"=>"siteuser","action"=>"signin","module"=>"default"));
        $router->addRoute("signin",$route);
        
        
        
        $front->registerPlugin(new Application_Plugin_GroupFilter());
        
        //check if it is a group else ignore
        
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
        
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
        Zend_Registry::set('config', $config);
    }
    
    
    protected function _initLayout()
    {
        $layout = Zend_Layout::startMvc();
        $this->bootstrap('view');
        $view = $this->getResource('view');
        
        $view->css = array(new Application_Model_Css("style.css"));
        $exJs = new Application_Model_Js("jq1.6");
        $view->js = array($exJs);
        $layout->setView($view);
        return $layout;
        
    }
    
    protected function _initAutoload()
    {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
                    'namespace' => 'Dashboard_',
                    'basePath' => APPLICATION_PATH . '/modules/dashboard'));
        
        $autoloader  = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace("App_");

        
        
    }
    
     protected function _initAcl()
    {
        
         //should possibly move to module bootstrap
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Application_Plugin_AuthFilter(Zend_Auth::getInstance(),new App_Acl_Acl()));
    }
    
    
        
}

