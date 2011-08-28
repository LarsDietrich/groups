<?php

class Application_Form_Join extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod("POST")->setAction("siteuser/create");
        $firstNameElement = new Zend_Form_Element_Text("firstname");
        $firstNameElement->setLabel("First Name")
                ->setOptions(array("size"=>"35","class"=>"textinput","placeholder"=>"First Name"))
                ->setRequired(TRUE)
                ->addValidator("NotEmpty",TRUE)
                ->addValidator("Alpha",TRUE)
                ->addFilter(new Zend_Filter_StripTags())
                ->addFilter(new Zend_Filter_StringTrim());
        
        $secondNameElement = new Zend_Form_Element_Text("secondname");
        $secondNameElement->setLabel("Second Name")
                ->setOptions(array("size"=>"35","class"=>"textinput","placeholder"=>"Second Name"))
                ->setRequired(TRUE)
                ->addValidator("NotEmpty",TRUE)
                ->addValidator("Alpha",TRUE)
                ->addFilter(new Zend_Filter_StripTags())
                ->addFilter(new Zend_Filter_StringTrim());
        
        $handleElement = new Zend_Form_Element_Text("handle");
        $handDbValidator = new Zend_Validate_Db_NoRecordExists('siteusers','handle');
        $handDbValidator->setMessage("That username already exists");
        $handleElement->setLabel("Username")
                ->setOptions(array("size"=>"35","maxlength"=>"10","class"=>"textinput","placeholder"=>"Username"))
                ->setRequired(TRUE)
                ->addValidator("NotEmpty",TRUE)
                ->addFilter(new Zend_Filter_Alnum(false))
                ->addFilter(new Zend_Filter_StripTags())
                ->addValidator($handDbValidator)
                ->addFilter(new Zend_Filter_StringTrim());
        
        $emailElement = new Zend_Form_Element_Text("email");
        $emailElement->setLabel("Email Address")
                ->setOptions(array("size"=>"35","class"=>"textinput","placeholder"=>"Email Address"))
                ->setRequired(TRUE)
                ->addValidator("NotEmpty",TRUE)
                ->addValidator(new Zend_Validate_EmailAddress())
                ->addFilter(new Zend_Filter_StringTrim());
        
        $passwordElement = new Zend_Form_Element_Password("password",array("size"=>"35","class"=>"textinput","placeholder"=>"Password (at least 5 chars)"));
        $passwordElement->setLabel("Password")
                ->setRequired()
                ->addValidator(new Zend_Validate_StringLength(5));
        
               
        $county = new Zend_Form_Element_Select("county");
        $counties = Zend_Registry::get("counties");
        if($counties){
            $mOptions = array(""=>"please select one");
            foreach($counties as $c){
                $mOptions[$c]=$c;
            }
        }
        $county->setMultiOptions($mOptions);
        $county->setRequired(TRUE);
        $county->addValidator("inArray", FALSE, $mOptions);
        $county->setLabel("County");
        
        
        $submit = new Zend_Form_Element_Submit("Join");
        
        
        $this->addElements(array($firstNameElement,$secondNameElement,$handleElement,$passwordElement,$emailElement,$county,$submit));
        
    }


}

