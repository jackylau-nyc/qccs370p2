<?php
//  Adapted from this tutorial: https://medium.com/the-andela-way/how-to-build-a-basic-server-side-routing-system-in-php-e52e613cf241.
namespace routing; 
require_once __DIR__.'/IRequest.php';

class Request implements IRequest {
  
    function __construct() {
        $this->bootstrapSelf();
    }
    
    private function bootstrapSelf(){
        foreach($_SERVER as $key => $value){
            $this->{$key} = $value;
        }
    } 

    public function getBody() {
        if($this->REQUEST_METHOD === "GET"){ 
        }

        if ($this->REQUEST_METHOD == "POST"){
            $body = array();
            foreach($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $body;
        }
    }
}