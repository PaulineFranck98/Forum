<?php

    namespace Model\Managers;

    use App\Manager;
    use App\DAO;
    use Model\Managers\CategoryManager;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";

        public function __construct(){
            
            parent::connect();

        }

        public function update($categoryId, $title){

            $sql = "UPDATE ".$this->tableName." c
                    SET c.title = :title
                    WHERE c.id_category = :id";

            $data = [
                'title' => $title,
                'id' => $categoryId
            ];

            DAO::update($sql, $data);
            
        }
       

    }

    