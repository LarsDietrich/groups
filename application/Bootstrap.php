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
        
        $route = new Zend_Controller_Router_Route('/create', array("controller" => "creategroup"));
        $router->addRoute("create", $route);
        
        $route = new Zend_Controller_Router_Route('/create/process', array("controller" => "creategroup", "action" => "process"));
        $router->addRoute("create/process", $route);
        
        $route = new Zend_Controller_Router_Route('/signin',array("controller"=>"siteuser","action"=>"signin"));
        $router->addRoute("signin",$route);
        
        $route = new Zend_Controller_Router_Route('/signout', array("controller" => "auth", "action" => "signout"));
        $router->addRoute("signout", $route);    
        
        // $route = new Zend_Controller_Router_Route('/dashboard',array("controller"=>"dashboard"));
        // $router->addRoute("dashboard",$route);
        
        // check if it is a group else ignore
        $front->registerPlugin(new Application_Plugin_GroupFilter());       
    }
    
    protected function _initRegistryValues()
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

        
        return $moduleLoader;
    }
    
    
    protected function _initAcl()
    {
        //should possibly move to module bootstrap
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Application_Plugin_AuthFilter(Zend_Auth::getInstance(),new Application_Model_Acl_Acl()));
    }
    
    
    
    
    




    
    
    
    
        
}

