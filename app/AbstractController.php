<?php
    namespace App;

    abstract class AbstractController{

        public function index(){}
        
        public function redirectTo($ctrl = null, $action = null, $id = null){
            // // $url = "index.php";
            // if($ctrl != "home"){
            //     $url = $ctrl ? "/".$ctrl : "";
            //     $url.= $action ? "/".$action : "";
            //     $url.= $id ? "/".$id : "";
            //     // $url.= ".php";
            // }
            // else $url = "/forum/";
            // header("Location: $url");
            // die();
            
            $url = "index.php?";
            if($ctrl != "home"){
                $url .= $ctrl ? "ctrl=".$ctrl : "";
                $url.= $action ? "&action=".$action : "";
                $url.= $id ? "&id=".$id : "";

            }else $url = "/forum/";
            header("Location: $url");
            die();

        }

        public function restrictTo($role){
            
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){
                $this->redirectTo("security", "login");
            }
            return;
        }

    }