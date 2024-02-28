<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    
    class HomeController extends AbstractController implements ControllerInterface{

        // function that allows to retrieve all categories
        public function index(){

            // creation of a new instance of the CategoryManager class => object creation
            $categoryManager = new CategoryManager();

            // creation of a variable '$categories' which will take the form of an array of objects.
            // I use the model layer to retrieve information from the database.
            // The model layer returns the results to the controller for processing.
            $categories = $categoryManager->findAll(["title", "DESC"]);
            
        
            // I return a view in HTML format
            // I send to the VIEW layer an array of data (variables)
                return [
                    "view" => VIEW_DIR."home.php",
                    "data" => [
                        'categories' =>$categories
                    ] 
                ];
            }
            
        
        // function that allows to retrieve all categories
        public function users(){
            // $this->restrictTo("ROLE_USER");

            // creation of a new instance of the UserManager class => object creation
            $manager = new UserManager();

            // creation of a variable '$users' which will take the form of an array of objects.
            // I use the model layer to retrieve information from the database.
            // The model layer returns the results to the controller for processing.
            $users = $manager->findAll(['username', 'DESC']);

            // I return a view in HTML format
            // I send to the VIEW layer an array of data (variables)
            return [
                "view" => VIEW_DIR."security/users.php",
                "data" => [
                    "users" => $users
                ]
            ];
        }

        // public function forumRules(){
            
        //     return [
        //         "view" => VIEW_DIR."rules.php"
        //     ];
        // }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/

       
        // function that allows to search for a category/topic/post/user 
        public function search($search){

            $search = filter_input(INPUT_POST, 'search' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // var_dump($search);die();

            // creation of a new instance of the UserManager class => object creation
            $userManager = new UserManager();

            // creation of a new instance of the CategoryManager class => object creation
            $categoryManager = new CategoryManager();

            // creation of a new instance of the TopicManager class => object creation
            $topicManager = new TopicManager();

            // creation of a new instance of the PostManager class => object creation
            $postManager = new PostManager();

            $users = $userManager->searchUsers($search);
            $categories = $categoryManager->searchCategories($search);
            $topics = $topicManager->searchTopics($search);
            $posts = $postManager->searchPosts($search);

            if($search){

                $data = [

                    "users" => $users,
                    "categories" => $categories,
                    "topics" => $topics,
                    "posts" => $posts,
                ];  
                
            }

            // I return a view in HTML format
            // I send to the VIEW layer an array of data (variables)
            return [
                "view" => VIEW_DIR."forum/searchPage.php",
                "data" => [
                    "users" => $users,
                    "categories" => $categories,
                    "topics" => $topics,
                    "posts" => $posts    
                ]
            ];

        }


    
    }
