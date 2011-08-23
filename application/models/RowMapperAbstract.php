<?php

abstract class Application_Model_RowMapperAbstract
{

    /**
     *
     * @var Zend_Db_Table_Abstract 
     */
    protected $_dbTable;
    protected $_model;
    
    
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
     */
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            throw new Exception("no dbtable set");
        }
        
        return $this->_dbTable;
    }
    
    
    public function findByExample(Application_Model_RowAbstract $row)
    {
        
        
    }
    
    public function saveUpdate(Application_Model_RowAbstract $row)
    {
        
    }


    public function findWherePriKeyEquals($value){
        $row = $this->getDbTable()->find($value);
        return $row;
        
    }

}

