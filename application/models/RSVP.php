<?php

class Application_Model_RSVP extends Application_Model_RowAbstract
{

    public $id, $invite_id, $status, $message, $added;
    
    protected $invite;
    
    public function getId() {
        return $this->id;
    }

    public function getInvite_id() {
        return $this->invite_id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getAdded() {
        return $this->added;
    }

    public function getInvite() {
        
        if(!isset($this->invite))
        {
            $mapper = new Application_Model_InvitesMapper();
            $this->invite = $mapper->findWherePriKeyEquals($this->invite_id);
        }
        return $this->invite;
    }


}

