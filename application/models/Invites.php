<?php

class Application_Model_Invites extends Application_Model_RowAbstract
{

    const INVITE_TYPE_EVENT = "event";
    const INVITE_TYPE_GROUP = "group";
    
    public $id,$relid,$type,$message,$members_id,$added;
    
    protected $member, $relatedEventOrGroup;
    
    public function getId() {
        return $this->id;
    }

    public function getRelid() {
        return $this->relid;
    }

    public function getType() {
        return $this->type;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getMembers_id() {
        return $this->members_id;
    }

    public function getAdded() {
        return $this->added;
    }

    /**
     * convienence method to get the member which sent the invite
     * @return Application_Model_Members 
     */
    public function getMember() {
        if(!isset($this->member))
        {
            $mapper = new Application_Model_MembersMapper();
            $this->member = $mapper->findWherePriKeyEquals($this->members_id);
        }
        return $this->member;
    }
    /**
     *
     * @return  Application_Model_RowAbstract
     * 
     * this method returns either an Event or a Group
     * depends on the type of invite
     */
    public function getRelatedEventOrGroup() {
        if(!isset($this->relatedEventOrGroup))
        {
            $mapper = null;
            switch ($this->type){
                case self::INVITE_TYPE_EVENT:
                    $mapper = new Application_Model_EventsMapper();
                    break;
                case self::INVITE_TYPE_GROUP:
                    $mapper = new Application_Model_GroupsMapper();
                    break;
                default :
                    break;
            }
            if($mapper instanceof Application_Model_RowMapperAbstract)
                $this->relatedEventOrGroup = $mapper->findWherePriKeyEquals ($this->relid);
        }
        return $this->relatedEventOrGroup;
    }


}

