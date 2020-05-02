<?php 
namespace utility;

class Validator{

    private  $request;
    private  $requiredParams; 
    private  $cleanData; 

    function __construct($request, $requiredParams){
        $this->requiredParams = $requiredParams;
        $this->request        = $request; 
    }

    function isValid(){
        return $this->parameterCheck();
    }
    
    private function parameterCheck(){
        foreach ($this->requiredParams as $req){
            if(!key_exists($req, $this->request)){
                error_log ("Request Field Missing: " . $req);
                return false;   
            }
            if(!isset($this->request[$req])){
                error_log("Request Field is Null: " . $req );
                return false; 
            }
            if (empty($this->request[$req])){
                error_log("Request Field is Empty: " . $req);
                return false; 
            }
        }
        return true; 
    } 

    function getSafeData(){
        if(! $this->isValid()){
            return false; 
        }
        foreach($this->requiredParams as $key){
           $this->cleanData[$key] =  strip_tags(trim( $this->request[$key]));
        }  
        return $this->cleanData; 
    }
    function getSafeHTMl(){
        if(! $this->isValid()){
            return false; 
        }
        foreach($this->requiredParams as $key){
            $this->cleanData[$key] =   htmlspecialchars( $this->request[$key]);
         }  
         return $this->cleanData; 
    }

}
