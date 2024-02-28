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

        public function index(){

            $categoryManager = new CategoryManager();

            $categories = $categoryManager->findAll(["title", "DESC"]);
            
            //on cherche le category Manager
            //on instancie une variable $categories avec un findAll()
           
                return [
                    "view" => VIEW_DIR."home.php",
                    "data" => [
                        'categories' =>$categories
                    ] 
                ];
            }
            
        
   
        public function users(){
            // $this->restrictTo("ROLE_USER");

            $manager = new UserManager();
            $users = $manager->findAll(['username', 'DESC']);

            return [
                "view" => VIEW_DIR."security/users.php",
                "data" => [
                    "users" => $users
                ]
            ];
        }

        public function forumRules(){
            
            return [
                "view" => VIEW_DIR."rules.php"
            ];
        }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/

        // public function searchPage($data){

        //     $userManager = new UserManager();
        //     $categoryManager = new CategoryManager();
        //     $topicManager = new TopicManager();
        //     $postManager = new PostManager();

        //     $users = $userManager->searchUsers($data);
        //     $categories = $categoryManager->searchCategories($data);
        //     $topics = $topicManager->searchTopics($data);
        //     $posts = $postManager->searchPosts($data);
            
    
        //     return [
        //         "view" => VIEW_DIR."forum/searchPage.php",
        //         "data" => [
        //             "users" => $users,
        //             "categories" => $categories,
        //             "topics" => $topics,
        //             "posts" => $posts
                    
                
        //         ]
        //     ];
        // }
      
        public function search($search){

            $search = filter_input(INPUT_POST, 'search' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // var_dump($search);die();
            $userManager = new UserManager();
            $categoryManager = new CategoryManager();
            $topicManager = new TopicManager();
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
