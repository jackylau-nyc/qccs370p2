<?php 
namespace utility;

class Validator{

    private  $request;
    private  $requiredParams; 
    private  $cleanData; 

    function __construct($request = null, $requiredParams = null){
        $this->requiredParams = $requiredParams;
        $this->request        = $request; 
    }

    function isValid(){
        return $this->parameterCheck();
    }

    /**
     * @param qstr =>  array("key1"=> "val1","key2"=> "val2") ...)
     * @param requiredParams =>  array("key1"=> "val1","key2"=> "val2") ...)
     * @return boolean true if all keys are present. 
     */
    public function varCheck($req, $requiredParams){
        foreach ($requiredParams as $requirement){
            if(!key_exists($requirement, $req)){
                return false;   
            }
        }
        return $req; 
    }

    /**
     * @param qstr =>  array("key1"=> "val1","key2"=> "val2") ...)
     * @param requiredParams =>  array("key1"=> "val1","key2"=> "val2") ...)
     * @return boolean true if all keys are present and assigned a value. 
     */
    
    public function strictVarCheck($qStr, $requiredParams){
        foreach ($requiredParams as $requirement){
            if(!key_exists($requirement, $qStr)){
                return false;   
            }
            if(!isset($this->request[$req])){
                return false; 
            }
        }
        return true; 
    }
    

    private function parameterCheck(){
        foreach ($this->requiredParams as $req){
            if(!key_exists($req, $this->request)){
                error_log ("Request Field Missing: " . $req );
                return false;   
            }
            if(!isset($this->request[$req])){
                error_log("Request Field is Null: " . $req );
                return false; 
            }
        }
        return true; 
    } 

    public function getSafeData(){
        if(! $this->isValid()){
            return false; 
        }
        foreach($this->requiredParams as $key){
           $this->cleanData[$key] =  strip_tags(trim( $this->request[$key]));
        }  
        return $this->cleanData; 
    }

    public function getSafeHTMl(){
        if(! $this->isValid()){
            return false; 
        }
        foreach($this->requiredParams as $key){
            $this->cleanData[$key] =   htmlspecialchars( $this->request[$key]);
         }  
         return $this->cleanData; 
    }

   function validateDate($date){
   }  
}
