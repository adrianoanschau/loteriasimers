<?php
/**
 * User: adrianoanschau
 * Date: 25/11/17
 * Time: 14:06
 */

class Json {

    public function get($filename){
        $filename = JSONPATH.$filename.".json";
        if(file_exists($filename)) return json_decode(file_get_contents($filename),true);
        else {
            $this->create($filename,array());
            return array();
        }
    }

    public function save($filename,$content){
        $filename = JSONPATH.$filename.".json";
        $this->create($filename,$content);
    }

    private function create($filename,$content){
        $fp = fopen($filename,"w");
        fwrite($fp,json_encode($content));
        fclose($fp);
    }

}