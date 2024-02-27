<?php

    namespace Model\Managers;

    use App\Manager;
    use App\DAO;
    use Model\Managers\UserManager;

    class UserManager extends Manager {

        protected $className = "Model\Entities\User";
        protected $tableName = "user";

        
        public function __construct(){
            parent::connect();
        }


        public function findOneByPseudo($username){

            $sql = "SELECT *
                    FROM ".$this->tableName." u
                    WHERE u.username = :username
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['username' => $username], false), 
                $this->className
            );

        }

        public function banUser($userId) {
            
            $sql = "UPDATE ".$this->tableName." u
                    SET u.banned = 1
                    WHERE u.id_user = :id";

            $data = [
                'id' => $userId
            ];

            DAO::update($sql, $data);
    
        }

        public function unBanUser($userId) {
            
            $sql = "UPDATE ".$this->tableName." u
                    SET u.banned = 0
                    WHERE u.id_user = :id";

            $data = [
                'id' => $userId
            ];

            DAO::update($sql, $data);
    
        }

        public function search($search){

            $sql = "SELECT * FROM ".$this->tableName ." u
                    WHERE u.username
                    LIKE :search";
            
            $data = [
                'search' => '%' . $search . '%'
            ];

            return $this->getMultipleResults(
                DAO::select($sql, $data, true), 
                $this->className
            );

        }

       
    }