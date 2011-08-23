<?php

abstract class Application_Model_RowAbstract
{
    
    public function __construct(array $propertiesAndVals = array()) {
        foreach($propertiesAndVals as $property=>$value)
            $this->__set ($property, $value);
    }

    public function __set($name, $value) {
        if(property_exists($this, $name))
        {
            $this->$name = $value;
        }
    }
    
    public function __get($name) {
        if(!property_exists($this, $name))
                return null;
    }
    
    
    public function hashCode(){
        return md5(get_class_vars($this));
    }
    
    public function equals(Application_Model_RowAbstract $row)
    {
        if($row->hashCode() == $this->hashCode())
            return true;
        return false;
    }
    
}

