<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $username;
        private $password;
        private $role;
        private $banned;
        private $avatar;

        public function __construct($data){
            $this->hydrate($data);
        }

        // Get the value of id
        public function getId(){

            return $this->id;
        }

        /**  Set the value of id
        * 
        * @return self
        */
        public function setId($id) {

            $this->id = $id;

            return $this;
        }

        // Get the value of username
        public function getUsername(){

            return $this->username;

        }

        /** Set the value of username
        * 
        * @return self
        */
        public function setUsername($username) {

            $this->username = $username;

            return $this;

        }

        // Get the value of password
        public function getPassword() {

            return $this->password;
        }

        /** Set the value of password
        * 
        * @return self
        */
        public function setPassword($password) {

            $this->password = $password;

            return $this;
        }

        // Get the value of role
        public function getRole(){

            return json_decode($this->role);
        }

        /** Set the value of role
        *
        * @return self
        */
        public function setRole($role){

            $this->role = json_encode($role);

            return $this;
        }

        public function hasRole($role){

            $result = $this->getRole()== json_encode($role);
            
            return $result;
        }

        
        // Get the value 
        public function getBanned() {

            return $this->banned;
        }

        /** Set the value 
        * 
        * @return self
        */
        public function setBanned($banned) {

            $this->banned = $banned;

            return $this;
        }

        // Get the value of avatar
        public function getAvatar() {

            return $this->avatar;
        }

        /** Set the value of avatar
        * 
        * @return self
        */
        public function setAvatar($avatar) {

            $this->avatar = $avatar;
            
            return $this;
}
        
        // public function __toString(){
            
        //     return $this->username;
        // }

    }

    