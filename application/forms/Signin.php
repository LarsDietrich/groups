<?php

class Application_Form_Signin extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod("POST");
        $this->setAction("signin");
        
        $usernameEle = new Zend_Form_Element_Text("handle",array("width"=>"35","placeholder"=>"username"));
        $usernameEle->addValidator(new Zend_Validate_Alnum())
                ->addFilter(new Zend_Filter_StringTrim())
                ->setLabel("Username")
                ->setRequired();
        
        $passwordEle = new Zend_Form_Element_Password("password",array("width"=>"35","placeholder"=>"password"));
        $passwordEle->setLabel("Password")->setRequired();
        
        $submitEle = new Zend_Form_Element_Submit("Login");
        
        $this->addElements(array($usernameEle,$passwordEle,$submitEle));
        
    }


}

