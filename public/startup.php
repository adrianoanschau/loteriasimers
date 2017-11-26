<?php
/**
 * User: adrianoanschau
 * Date: 25/11/17
 * Time: 11:59
 */

define("TITLE","Loteria Simers - Sistema de Apostas");

define("BASEURL","//{$_SERVER['HTTP_HOST']}/");
define("PUBLICPATH",$_SERVER['DOCUMENT_ROOT']);
define("TEMPLATES",dirname($_SERVER['DOCUMENT_ROOT'])."/templates/");
define("JSONPATH","{$_SERVER['DOCUMENT_ROOT']}assets/json/");

function dump($dump){
    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
}

function format($n){
    return str_pad($n,2,'0',STR_PAD_LEFT);
}

function autoload($classname){
    $classname = ucfirst(strtolower($classname));
    $filename = dirname(PUBLICPATH) . "/classes/{$classname}";
    if(file_exists($filename.".php")) include $filename.".php";
    else if(file_exists($filename.".controller.php")) include $filename.".controller.php";
    else echo "Classe <u>{$classname}</u> não existe!";
}

spl_autoload_register('autoload');