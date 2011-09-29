<?php

class Application_Form_CreateGroup extends Zend_Form
{

    public function init()
    {
        /* Group Basics 
         * - Group name
         * - Group description
         * - Category
         */
        // Create group subform: group name and group description
        $group = new Zend_Form_SubForm();
        $group->addElements(array(
            new Zend_Form_Element_Text('group_name', array(
                'required' => true,
                'label' => 'Group Name:',
                'filters' => array('StringTrim'),
                'validators' => array(new zend_vali
                    
                )
        )),
            
            new Zend_Form_Element_Text('description', array(
                'required' => true,
                'label' => 'Group Description:',
                'filters' => array('StringTrim'),
                'validators' => array(
                    
                )
            )),
            
         ));
            
        
        /* If not logged_in
         * - Username
         * - Email
         * - Password
         * - County
         * 
         * Create group and user at this point, and have them logged in.
         * Send off emails.
         * - Create mailer
         * 
         * If they never go beyond this point it is okay.
         * Provide options to skip everything beyond this point.
         */
        // Create user subform: username, password, email, county
        
//        $counties = Zend_Registry::get("counties");
//        if($counties){
//            $countyOptions = array(""=>"Select one");
//            foreach($counties as $c){
//                $countyOptions[$c]=$c;
//            }
//        }
        
        $countyOptions = array(
            'none'        => 'No lists, please',
            'fw-general'  => 'Zend Framework General List',
            'fw-mvc'      => 'Zend Framework MVC List',
            'fw-auth'     => 'Zend Framwork Authentication and ACL List',
            'fw-services' => 'Zend Framework Web Services List',
        );
        
        $user = new Zend_Form_SubForm();
        $user->addElements(array(
            new Zend_Form_Element_Text('username', array(
                'required' => true,
                'label' => 'Username:',
                'filters' => array('StringTrim', 'StringToLower'),
                'validators' => array(
                    'Alnum',
                    array('Regex',
                          false,
                          array('/^[a-z][a-z0-9]{2,}$/'))
                )
            )),
            
            new Zend_Form_Element_Password('password', array(
                'required' => true,
                'label' => 'Password:',
                'filters' => array('StringTrim'),
                'validators' => array(
                    'NotEmpty',
                    array('StringLength', false, array(6))
                )
            )),
            
            new Zend_Form_Element_Text('email', array(
                'required' => true,
                'label' => 'Email:',
                'filters' => array('StringTrim'),
                'validators' => array(
                    'NotEmpty',
                )
            )),
        ));
        
        /* Categorise
         * - Category
         * - Tags
         */
        // Create category subform: category, tags
        
        
        /* Find Members 
         * - Invite existing members with similar interests
         * - Invite friends from facebook
         */
        
        
        
        /* Pay 
         * - Pay 10euro to create group
         */
        
        
        
        /* Confirmation 
         * - Yay, group created. Start meeting up.
         */
        
        $this->addSubForms(array(
           'group' => $group,
           'user' => $user
        ));
    }
    
    /**
     * Prepare a sub form for display
     * 
     * @param Zend_Form_SubForm $spec
     * @return Zend_Form_SubForm 
     */
    public function prepareSubForm($spec)
    {
        if (is_string($spec)) {
            $subForm = $this->{$spec};
        } elseif ($spec instanceof Zend_Form_SubForm) {
            $subForm = $spec;
        } else {
            throw new Exception('Invalid argument passed to ' .
                __FUNCTION__ . '()');
        }
        $this->addSubmitButton($subForm)
            ->setSubFormDecorators($subForm)
            ->addSubFormActions($subForm);
        return $subForm;
    }
    
    /**
     * Add form decorators to an individual sub form
     * 
     * @param Zend_Form_SubForm $subForm
     * @return Application_Form_CreateGroup 
     */
    public function setSubFormDecorators(Zend_Form_SubForm $subForm)
    {
        $subForm->setDecorators(array(
           'FormElements',
            array('HtmlTag', array('tag' => 'dl',
                                   'class' => 'zend_form')),
            'Form',
        ));
        
        return $this;
    }
    
    /**
     * Add a submit button to an individual sub form
     * 
     * @param Zend_Form_SubForm $subForm
     * @return Application_Form_CreateGroup 
     */
    public function addSubmitButton(Zend_Form_SubForm $subForm)
    {
        $subForm->addElement(new Zend_Form_Element_Submit(
                'save',
                array(
                    'label' => 'Save and continue',
                    'required' => false,
                    'ignore' => true,
                )
        ));
        
        return $this;
    }
    
    /**
     * Add action and method to sub form
     * 
     * @param Zend_Form_SubForm $subForm
     * @return Application_Form_CreateGroup 
     */
    public function addSubFormActions(Zend_Form_SubForm $subForm)
    {
        $subForm->setAction('/groups/create/process')
                ->setMethod('post');
        return $this;
    }
}

