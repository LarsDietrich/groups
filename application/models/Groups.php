<?php

class Application_Model_Groups extends Application_Model_RowAbstract
{


    public $id, $owner_id,$added,$name,$status,$tags, $location_id,$category,$description, $url;
    
    protected $owner, $location,$events,$members, $activity = null;
    
    public function getId() {
        return $this->id;
    }

    public function getOwner_id() 
    {
        return $this->owner_id;
    }

    public function getAdded() 
    {
        return $this->added;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getStatus() 
    {
        return $this->status;
    }

    public function getTags() 
    {
        return $this->tags;
    }

    public function getLocation_id() 
    {
        return $this->location_id;
    }

    public function getCategory() 
    {
        return $this->category;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function getUrl() {
        return $this->url;
    }
    
    
    
    public function createGroupUrl()
    {
        if(! isset($this->name) )
                throw new Application_Exception_ModelException ("no name set for creating a url from ".__CLASS__."::name must be set");
        
        $this->url = strtolower( preg_replace('/[^A-Za-z0-9_-]+/', '-', $this->name) );
        
        
    }

            
    /**
     *
     * @return Application_Model_SiteUsers 
     * convienience method for getting the site user object associated with
     * the group 
     */
    public function getOwner()
    {
        if(!isset($this->owner))
        {
            
            $mapper = new Application_Model_SiteUsersMapper();
            $this->owner = $mapper->findWherePriKeyEquals($this->owner_id);
        }
        return $this->owner;
    }
    
    /**
     *
     * @return Application_Model_Locations
     * convienence method for getting the location object associated with the 
     * group
     *  
     */
    public function getLocation()
    {
     
        if(!isset($this->location))
        {
            $mapper = new Application_Model_LocationsMapper();
            $this->location = $mapper->findWherePriKeyEquals($this->location_id);
        }
        return $this->location;
                
    }
    
    /**
     *
     * @param int $timestamp
     * @return array
     * convience method to get events for a group after
     * a given timestamp must be a unix timestamp 
     */
    public function getGroupEventsAfterTimestamp($timestamp)
    {
        if(!isset($this->events))
        {
            $mapper = new Application_Model_EventsMapper();
            $this->events = $mapper->getEventsByGroupIdAndAfterDate($this->id, $timestamp);
        }
        return $this->events;
    }
    
    /**
     *convienence method to get all the members of a group
     * @return array
     */
    public function getGroupMembers()
    {
        if(!isset($this->members))
        {
            $mapper = new Application_Model_MembersMapper();
            $this->members = $mapper->findAllByExample(new Application_Model_Members(array("group_id"=>$this->id)));
        }
        return $this->members;
    }
    
    /**
     *convienence method to get all the group activity logs after specified date
     * @return array
     */
    public function getGroupActivityFromTime($timestamp = NULL)
    {
        
        $timestamp = (NULL === $timestamp)?strtotime("30 days ago"):intval($timestamp);
        if(NULL == $this->activity){
            
            $mapper = new Application_Model_ActivityLogMapper();
            
            $this->activity = $mapper->getGroupActivityAfterTime($this->id, $timestamp);
        }
        return $this->activity;
    }
}

