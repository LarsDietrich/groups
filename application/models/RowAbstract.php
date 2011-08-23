<?php
/**
 * @author Craig Brookes
 * All Model classes should extend this class
 */
abstract class Application_Model_RowAbstract
{
    /**
     *
     * @param array $propertiesAndVals 
     */
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
    
    /**
     * should be overriden if neccessary
     */
    public function hashCode(){
        return md5(get_class_vars($this));
    }
    
    /**
     * should be overridden if neccessary
     */
    public function equals(Application_Model_RowAbstract $row)
    {
        return ($row->hashCode() == $this->hashCode());
           
    }
    
}

