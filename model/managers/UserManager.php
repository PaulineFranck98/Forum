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

       
    }