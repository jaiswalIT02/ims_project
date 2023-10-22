<?php

    class User{
        function __constructor(){

        }
    
        public static function userisLoginIn(){
            if(isset($_SESSION['user_name'])){
                return true;
            }
            return false;         
        }

        public static function UserLogout()
        {
            session_destroy();
            unset($_SESSION["user_email"]);
            unset($_SESSION["user_name"]);  
            
            header('location:/');
        }
    
    }