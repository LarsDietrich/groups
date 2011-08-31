<?php

class Application_Model_ActivityLog extends Application_Model_RowAbstract
{

    public $id, $members_id, $groups_id, $description, $added;
    
    
    protected $member = null,$group = null;
    
    public function getId() {
        return $this->id;
    }

    public function getMembers_id() {
        return $this->members_id;
    }

    public function getGroups_id() {
        return $this->groups_id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getAdded() {
        return $this->added;
    }

    public function getMember() {
        if(null === $this->member){
            $mapper = new Application_Model_MembersMapper();
            $this->member = $mapper->findWherePriKeyEquals($this->members_id);
        }
        return $this->member;            
    }

    public function getGroup() {
        if(null === $this->group)
        {
            $mapper = new Application_Model_GroupsMapper();
            $this->group = $mapper->findWherePriKeyEquals($this->groups_id);
        }
        return $this->group;
    }


}

