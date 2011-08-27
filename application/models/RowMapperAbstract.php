<?php

/**
 * @author Craig Brookes
 * 
 * All concrete Data Mapper classes for the application
 * should extend this base class
 */


abstract class Application_Model_RowMapperAbstract
{

    /**
     *
     * @var Zend_Db_Table_Abstract 
     */
    protected $_dbTable;
    protected $_model;
    
    /**
     *
     * @param String $tableName
     * @param String $model 
     * sets up concrete extension of Zend_Db_Table_Abstract to be queried
     */
    public function __construct($tableName, $model = "stdClass") {
        $this->setDbTable($tableName);
        $this->_model = $model;
        
    }
    
    
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('you must pass a class that extends Zend_Db_Table_Abstract');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    /**
     *
     * @return Zend_Db_Table_Abstract 
     * return concrete child
     */
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            throw new Exception("no dbtable set");
        }
        
        return $this->_dbTable;
    }
    
    /**
     *
     * @param Application_Model_RowAbstract $row
     * @return array 
     * returns an array of concrete children extending Application_Model_RowAbstract
     */
    public function findAllByExample(Application_Model_RowAbstract $row)
    {
        //returns all public properties and their values in assoc array
        $props = get_object_vars($row);
        $sql = $this->getDbTable()->select();
        foreach($props as $property=>$value){
            if(!NULL == $value)
                $sql->where(''.$property.' = ?',$value);
        }
        
        $rows =  $sql->query()->fetchAll();
        $ret = array();
        foreach($rows as $row){
            $ret[]= new $this->_model($row);
        }
        return $ret;

    }
    
    
    public function findAllByFieldsAndValues($fieldsAndValues = array())
    {
        $sql = $this->getDbTable()->select();
        foreach($fieldsAndValues as $field=>$value)
        {
            $sql->where(''.$field.'=?',$value);
        }
        $rows = $sql->query()->fetchAll();
        $ret = array();
         foreach($rows as $row){
            $ret[]= new $this->_model($row);
        }
        return $ret;
    }


    /**
     *
     * @param Application_Model_RowAbstract $row
     * @return Application_Model_RowAbstract
     * returns a concrete child 
     */
    public function findRowByExample(Application_Model_RowAbstract $row){
        $props = get_object_vars($row);
        $sql = $this->getDbTable()->select();
        foreach($props as $property=>$value){
            if(! NULL == $value)
                $sql->where(''.$property.' = ?',$value);
        }
        
        $sql->limit(1);       
        $rows =  $sql->query()->fetchObject($this->_model);
        return $rows;
    }


    /**
     *
     * @param Application_Model_RowAbstract $row 
     * 
     * chooses to save or update based on whether the primary key is set or not
     */
    public function saveUpdate(Application_Model_RowAbstract $row)
    {
        //get pri key from get_primary() public method added 
        //to concrete implimentation of Zend_Db_Table_Abstract
        $prikey = $this->getDbTable()->get_primary();
        $prikey = $prikey[1];
        $data = get_object_vars($row);
        if(isset($row->$prikey)){
            //update
            $updateData = array();
            foreach($data as $property=>$value){
                if(!NULL == $value)
                    $updateData[$property]=$value;
            }
            
            $this->getDbTable()->update($updateData, ''.$prikey.'='.$row->$prikey.'');
        }else{
            //insert
            $row->id = $this->getDbTable()->insert($data);
        }
        
        return $this->findWherePriKeyEquals($row->id);
        
    }

    /**
     *
     * @param mixed $value
     * @return Application_Model_RowAbstract
     * the value is the value of the primary key set for the row 
     */
    public function findWherePriKeyEquals($value){
        
        $row = $this->getDbTable()->find($value);
        $ret = $row->current();
        return new $this->_model($ret->toArray());
        
    }

}