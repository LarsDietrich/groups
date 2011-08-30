<?php

class Application_Model_SiteUsers extends Application_Model_RowAbstract
{

    public $id,$firstname,$handle,$secondname,$email,$location_id, $added, $lastlogin,$password;
    
    protected $groups= null, $members = null;
    
    public function getId() {
        return $this->id;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getHandle() {
        return $this->handle;
    }

    public function getSecondname() {
        return $this->secondname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getLocation_id() {
        return $this->location_id;
    }

    public function getAdded() {
        return $this->added;
    }

    public function getLastlogin() {
        return $this->lastlogin;
    }
    
    public function getPassword() {
        return $this->password;
    }

    
    /**
     *
     * @return array
     * finds the groups associated with site user 
     */
    public function getGroups() {
        
        if(null === $this->groups)
        {
            
            $this->groups = array();
            $mapper = new Application_Model_GroupsMapper();
            $mems =$this->getMembers();
            
            
            if(is_array($mems))
            {
                foreach($mems as $member)
                {
                    $this->groups[]=$mapper->findWherePriKeyEquals($member->group_id);
                }
            }
        }
        return $this->groups;
    }

    /**
     *
     * @return array
     * finds all members of groups made be site user 
     */
    public function getMembers() {
        
        
        
        if(NULL === $this->members)
        {
            $mapper = new Application_Model_MembersMapper();
            $this->members = $mapper->findAllByFieldsAndValues(array("user_id"=>$this->id));
        }
        return $this->members;
    }
    
    public function equals(Application_Model_RowAbstract $row) {
        if($row instanceof Application_Model_SiteUsers && $this->handle == $row->handle)
            return true;
        else
            return false;
    }


    public static function validateSiteUser(Application_Model_SiteUsers $user)
    {
        $mapper = new Application_Model_SiteUsersMapper();
        $otherUser = $mapper->findWherePriKeyEquals($user->id);
        if($user->equals($otherUser))
            return true;
        else
            return false;
    }



}

