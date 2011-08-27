<?php

class Application_Model_MemberPermissions extends Application_Model_RowAbstract
{

        public $id,$member_id,$group_id,$permission,$allowed;
        
        protected $group,$member;
        
        
        public function getId() {
            return $this->id;
        }

        public function getMember_id() {
            return $this->member_id;
        }

        public function getGroup_id() {
            return $this->group_id;
        }

        public function getPermission() {
            return $this->permission;
        }

        public function getAllowed() {
            return $this->allowed;
        }

        /**
         *
         * @return Application_Model_Groups
         * returns the associated Groups object 
         */
        public function getGroup() {
            if(!isset($this->group))
            {
                $mapper = new Application_Model_GroupsMapper();
                $this->group = $mapper->findWherePriKeyEquals($this->group_id);
            }
        
            return $this->group;
        }

        /**
         *
         * @return Application_Model_Members
         * returns associated Member
         */
        public function getMember() {
            
            if(!isset($this->member))
            {
                $mapper = new Application_Model_MembersMapper();
                $this->member = $mapper->findWherePriKeyEquals($this->member_id);
            }
            return $this->member;
        }


}

