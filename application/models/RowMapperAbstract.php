<?php

/**
 * @author Craig Brookes
 * 
 * All Data Mapper classes for the application
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
     * sets up the Zend_Db_Table to be queried
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
            throw new Exception('Invalid table data gateway provided');
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
     * @return Application_Model_RowAbstract
     * returns a concrete child 
     */
    public function findAllByExample(Application_Model_RowAbstract $row)
    {
        $props = get_object_vars($row);
        $sql = $this->getDbTable()->select();
        foreach($props as $property=>$value){
            if($value != NULL)
                $sql->where(''.$property.' = ?',$value);
        }
        
               
        $rows =  $sql->query()->fetchAll();
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
            if($value != NULL)
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
        //get pri key
        $prikey = $this->getDbTable()->get_primary();
        $prikey = $prikey[1];
        if(isset($row->$prikey)){
            //update
            $data = get_object_vars($row);
            $updateData = array();
            foreach($data as $property=>$value){
                if($value != NULL)
                    $updateData[$property]=$value;
            }
            $this->getDbTable()->update($updateData, ''.$prikey.'='.$row->$prikey.'');
        }else{
            //insert
            $data = get_object_vars($row);
            $this->getDbTable()->insert($data);
        }
        
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

