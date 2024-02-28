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

        // method to retrieve all categories
        public function index(){

            // creation of a new instance of the CategoryManager class => object creation
            $categoryManager = new CategoryManager();

            // creation of a variable '$categories' which will take the form of an array of objects.
            // I use the model layer to retrieve information from the database.
            // The model layer returns the results to the controller for processing.
            $categories = $categoryManager->findAll(["title", "DESC"]);
            
        
            // return a view in HTML format
                return [
                    "view" => VIEW_DIR."home.php",
                    // send to the VIEW layer an array of data (variables)
                    "data" => [
                        'categories' =>$categories
                    ] 
                ];
            }
            
        
        // method to retrieve all users
        public function users(){

            // $this->restrictTo("ROLE_USER");
            // creation of a new instance of the UserManager class => object creation
            $manager = new UserManager();

            // creation of a variable '$users' which will take the form of an array of objects.
            // I use the model layer to retrieve information from the database.
            // The model layer returns the results to the controller for processing.
            $users = $manager->findAll(['username', 'DESC']);

            // return a view in HTML format
            return [
                "view" => VIEW_DIR."security/users.php",
                // send to the VIEW layer an array of data (variables)
                "data" => [
                    "users" => $users
                ]
            ];
        }

      

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/

       
        // method to search for a category/topic/post/user 
        public function search($search){

            // retrieves 'search' from the POST request, sanitize the input
            $search = filter_input(INPUT_POST, 'search' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        

            // creation of a new instance of the UserManager class => object creation
            $userManager = new UserManager();

            // creation of a new instance of the CategoryManager class => object creation
            $categoryManager = new CategoryManager();

            // creation of a new instance of the TopicManager class => object creation
            $topicManager = new TopicManager();

            // creation of a new instance of the PostManager class => object creation
            $postManager = new PostManager();

            //creation of a variable '$users'
            $users = $userManager->searchUsers($search);
            //creation of a variable '$categories'
            $categories = $categoryManager->searchCategories($search);
            //creation of a variable '$topics'
            $topics = $topicManager->searchTopics($search);
            //creation of a variable '$posts'
            $posts = $postManager->searchPosts($search);
            //use model layer to retrieve information from the database
            //model layer returns the results to the controller for processing.

            // check if search vas provided
            if($search){
                // prepare data
                $data = [

                    "users" => $users,
                    "categories" => $categories,
                    "topics" => $topics,
                    "posts" => $posts,
                ];  
                
            }

            //Return a view in HTML format
            return [
                "view" => VIEW_DIR."forum/searchPage.php",
                //Send to the VIEW layer an array of data (variables)
                "data" => [
                    "users" => $users,
                    "categories" => $categories,
                    "topics" => $topics,
                    "posts" => $posts    
                ]
            ];

        }


    
    }
