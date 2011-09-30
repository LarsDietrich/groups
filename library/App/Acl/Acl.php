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
class App_Acl_Acl extends Zend_Acl{
    
    const ACL_ROLE_GUEST          = "Guest";
    const ACL_ROLE_GROUP_MEMBER   = "Member";
    const ACL_ROLE_GROUP_ADMIN    = "Admin";
    const ACL_ROLE_SITE_ADMIN     = "SiteAdmin";
    
    
    public function __construct() {
        

       
        $this->addRole(new Zend_Acl_Role(self::ACL_ROLE_GUEST))
             ->addRole(new Zend_Acl_Role(self::ACL_ROLE_GROUP_MEMBER),self::ACL_ROLE_GUEST)
             ->addRole(new Zend_Acl_Role(self::ACL_ROLE_GROUP_ADMIN), self::ACL_ROLE_GROUP_MEMBER)
             ->addRole(new Zend_Acl_Role(self::ACL_ROLE_SITE_ADMIN),  self::ACL_ROLE_GROUP_ADMIN);
        
        
        $this->addResource("dashboard.index")
             ->addResource("default.index")
             ->addResource("default.siteuser")
             ->addResource("default.group")
             ->addResource("dashboard.show");
        
        $this->allow(self::ACL_ROLE_GUEST,"default.index")
             ->allow(self::ACL_ROLE_GUEST,"default.siteuser")
             ->allow(self::ACL_ROLE_GUEST,"default.group")
             ->allow(self::ACL_ROLE_GROUP_MEMBER, "dashboard.index")
             ->allow(self::ACL_ROLE_GROUP_MEMBER, "dashboard.show");
        
        
    }
    
}

?>
