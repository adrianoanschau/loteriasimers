<?php
/**
 * User: adrianoanschau
 * Date: 25/11/17
 * Time: 12:05
 */

class App {

    private function __construct(){}

    static function start(){
        if(isset($_REQUEST['path'])){
            $path = explode("/",$_REQUEST['path']);
            $controller = (isset($path[0])&&$path[0])?$path[0]:"Home";
            $action = (isset($path[1])&&$path[1])?$path[1]:"index";
            unset($path[0]); unset($path[1]);
            (new $controller)->$action(implode("/",$path));
        } else {
            (new Home)->index();
        }
    }

}