<?php

class Session {
    
    static function start() {
        @session_start();
    }

    static function getSession($name){
        return $_SESSION[$name];
    }
    
    static function setSession($name,$data){
        $_SESSION[$name]=$data;
    }
    
    static function destroy(){
        @session_destroy();
    }
    
    static function unsetSession($name){
        unset($_SESSION[$name]);
    }
    static function issetSession($name){
        return isset($_SESSION[$name]);
    }
    
    
    
}
