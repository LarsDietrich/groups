<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acl
 *
 * @author craigbrookes
 */
class Application_Model_Acl_Acl extends Zend_Acl {
    //put your code here
    public function __construct() {
       
        
        
        
        
        
        
        $this->addRole(new Zend_Acl_Role('Guest')); 
        $this->addRole(new Zend_Acl_Role('Member'), 'Guest');
        $this->addRole(new Zend_Acl_Role('Admin'), 'Member');
        
        $this->addResource(new Zend_Acl_Resource("dashboard"));
        $this->addResource(new Zend_Acl_Resource("groups"));
        $this->addResource(new Zend_Acl_Resource("siteuser"));
        $this->addResource(new Zend_Acl_Resource("index"));
        $this->allow("Guest", array("index","siteuser"));
        $this->allow("Member", "dashboard");
        $this->deny("Member", "dashboard","admin");
        $this->allow("Admin","dashboard");
    }
}

?>
