<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\UserManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function registerForm(){

            return [
                "view" => VIEW_DIR."security/registerForm.php"
            
            ];

        }


        public function register() {

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $createPassword = filter_input(INPUT_POST, 'createPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $repeatPassword = filter_input(INPUT_POST, 'repeatPassword', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/[A-Za-z0-9].{8,32}/"]] );


            if($createPassword == $repeatPassword){
           
                $userManager = new UserManager();

                $userExisting = $userManager->findOneByPseudo($username);

                if(!$userExisting){

                    $hashedPassword = password_hash($createPassword, PASSWORD_DEFAULT);

                    $data = [
                        'username' => $username,
                        'password' => $hashedPassword,
                        'is_banned' => 0,
                        'role' => json_encode(['ROLE_USER'])
                    ];

                    $result = $userManager->add($data);
                    // var_dump($data);die();

                    if($result){
                        
                        Session::addFlash('success', 'Registration Successful');
                        $this->redirectTo("home");

                        
                    } 

                        Session::addFlash('error', 'Something went wrong');
                
                      return $this->redirectTo("security", "registerForm");

                  

                } else {

                    Session::addFlash('error', 'Username already taken');

                    return $this->redirectTo("security", "registerForm");
                }  
                   
            } else {

                Session::addFlash('error', 'Incorrect Password or Not Strong Enough');
                return $this->redirectTo("security", "registerForm");    
            }     
        }


        public function loginForm(){

            return [
                "view" => VIEW_DIR."security/loginForm.php"
            
            ];
        }


        public function login(){

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $userManager = new UserManager();

            $userExisting = $userManager->findOneByPseudo($username);

            // var_dump($userExisting); die();

            if($userExisting){

                // get user's password from bdd
                $bddPassword = $userExisting->getPassword();
                
                // native function : verifies that the given hash matches the given password
                if(password_verify($password, $bddPassword )){
                    // var_dump('super'); die();

                    // set user in session
                    Session::setUser($userExisting);

                    return $this->redirectTo("home");

                }

            }  else {

                Session::addFlash('error', 'User not found');
                return $this->redirectTo("security", "loginForm"); 

            }
        }

        public function logout(){

            Session::unsetUser();
            Session::addFlash('success', 'Log Out Successful');
            return $this->redirectTo("home");

        }
         
    }


    
    //verifier si le pseudo n'est pas deja en bdd
    //creer une methode qui récupère le user avec son username dans le userManager

    //si different de user alors je hash le mdp avec fonction native php

    //et je créée mes datas

    //var_dump de datas avant d'envoyer en bdd

    // à quoi sert password_hash: algo fort? algo faible ? password default il prend qui et pourquoi? quel algo est utilisé?
    //  --> strong one-way
    // Use the bcrypt algorithm : constant designed to change overtime : length can change over time (minimum 60 characters)



    
  




    // $hashedPassword = password_hash($createPassword, PASSWORD_DEFAULT);
    // PASSWORD_DEFAULT :  use bcrypt algorithm (default), but the constant is designed to change over time
    // --> use the stronger algorithm and use brcrypt or Argon2i  



    
    // Regex:(short for regular expression) a regex is a string of text that allows to create patterns that help match, locate, and manage text.
        /* VOIR GLOSSAIRE
        
        Password conditions : 
            -at least one digit [0-9]
            -at least one lowercase [a-z]
            -at least one uppercase [A-Z]
            -at least one special character [*.!@#$%^&(){}[]:;<>,.?/~_+-=|\]
            -at least 8 characters (not more than 32)
            --> pattern : 
            ^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]).{8,32}$
        */
        //  test1 : Motdepasse1
        //  test2 : Motdepasse2
        

        // OK dans forum controller : get the id of the user in session 
        // OK quand je poste, je récupère l'id en session : actuellement en dur (id user = 1) mais dois récupérer l'id_user en session 

        // si user en session différent de celui qui a posté alors ne peut pas éditer ni supprimer le post / ni bloquer (closed) le topic : si topic bloqué : ne peux plus répondre au topic : pas de post
        // créer compte admin : JSON [ADMIN_ROLE]


        // ban un user 
        // 



       
    