<?php

    namespace Model\Managers;

    use App\Manager;
    use App\DAO;
    use Model\Managers\CategoryManager;

    // Inheritance principle
    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";

        public function __construct(){
            // Inheritance 
            // CategoryManager inherits all of the public and protected methods, properties and constants from the parent class Manager
            parent::connect();

        }

        // method to update the category title 
        public function update($categoryId, $title){

            // creation of variable $sql that stores sql query
            $sql = "UPDATE ".$this->tableName." c
                    SET c.title = :title
                    WHERE c.id_category = :id";
            // prepare data
            $data = [
                'title' => $title,
                'id' => $categoryId
            ];

            // Use resolution operator(`::`)to access static properties and methods of DAO class without requiring object instantiation.
            DAO::update($sql, $data);
            
        }

        // method to retrieve categories when searched in search bar
        public function searchCategories($search){

             // creation of variable $sql that stores sql query
            $sql = "SELECT * FROM ".$this->tableName ." c
                    WHERE c.title
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

    