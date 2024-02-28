<?php

    namespace Model\Managers;

    use App\Manager;
    use App\DAO;
    use Model\Managers\UserManager;

    // Inheritance principle
    class UserManager extends Manager {

        protected $className = "Model\Entities\User";
        protected $tableName = "user";

        
        public function __construct(){
            // Inheritance 
            // UserManager inherits all of the public and protected methods, properties and constants from the parent class Manager
            parent::connect();
        }

        // method to retrieve a user by its username
        public function findOneByPseudo($username){
             // creation of variable $sql that stores sql query
            $sql = "SELECT *
                    FROM ".$this->tableName." u
                    WHERE u.username = :username";

            // prepare data   
            $data = [
                'username' => $username
            ];

            return $this->getOneOrNullResult(
                // Use resolution operator(`::`)to access static properties and methods of DAO class
                DAO::select($sql, $data, false), 
                $this->className
            );

        }

        // method to ban a user (set banned=1)
        public function banUser($userId) {

             // creation of variable $sql that stores sql query
            $sql = "UPDATE ".$this->tableName." u
                    SET u.banned = 1
                    WHERE u.id_user = :id";

            // prepare data
            $data = [
                'id' => $userId
            ];

            // Use resolution operator(`::`)to access static properties and methods of DAO class
            DAO::update($sql, $data);
    
        }

        // method to unban a user (set banned=0)
        public function unBanUser($userId) {

             // creation of variable $sql that stores sql query
            $sql = "UPDATE ".$this->tableName." u
                    SET u.banned = 0
                    WHERE u.id_user = :id";

            // prepare data
            $data = [
                'id' => $userId
            ];

            // Use resolution operator(`::`)to access static properties and methods of DAO class
            DAO::update($sql, $data);
    
        }
        
        //method to retrieve user name when searched in search bar
        public function searchUsers($search){

             // creation of variable $sql that stores sql query
            $sql = "SELECT * FROM ".$this->tableName ." u
                    WHERE u.username
                    LIKE :search";

            // prepare data
            $data = [
                'search' => '%' . $search . '%'
            ];

            return $this->getMultipleResults(
                // Use resolution operator(`::`)to access static properties and methods of DAO class
                DAO::select($sql, $data, true), 
                $this->className
            );

        }
       
    }