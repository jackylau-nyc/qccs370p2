<?php
    namespace dal;
    use PDO, database; 

    if(file_exists(__DIR__.'/../database/db-credentials.php')){
         require_once __DIR__.'/../database/db-credentials.php';
     } else {
         require_once __DIR__.'/../database/db-prod.php';
    }
   
class BaseLink {

    protected function openConnection() {
        try{
            $connection = new PDO(DSN, DB_USER, DB_PASS);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e){
            $connection = null; 
            print "Error!: " . $e->getMessage();
            die();
        }
        return $connection;            
    }
    /**
     * For select queries.  
     */
    protected function query($sql, $params){
        $connection = $this->openConnection();
        $result     = $connection->prepare($sql);
        $connection = null;
        $result->execute($params);

        if(!$this->validResult($result)){
            return null;    
        }
        $results = $result->fetchALL(PDO::FETCH_ASSOC);
        $result  = null; 
        return  $results;  
    }

     /**
     * For insert queries.  
     */

    protected function inQuery($sql, $params){
        $connection = $this->openConnection();
        $result     = $connection->prepare($sql);
        $connection = null;
        $result->execute($params);
        if(!$this->validResult($result)){
            return null;    
        }
        return  $result;  
    }

    protected function validResult($result){
        return ($result->rowCount() > 0);  
    }
    
    /**
     * 
     */
    protected function transaction($stmnts, $params){
        try{
            $connection = $this->openConnection();   
            $prepStmnts = []; 
            $connection->beginTransaction();
            $count  = count($stmnts);
            for ($i = 0; $i < $count; $i++){
                $result = $connection->prepare($stmnts[$i]);
                $result->execute($params[$i]); 
            }

            $connection->commit();
            $connection = null;    
            return  $result->fetchALL(PDO::FETCH_ASSOC); 
        } 
        catch(Exception $e){
            echo  "Unable to handle request at this time";
            error_log ($e->getMessage());
            $connection->rollBack();
        }
    }

    /**
     * 
     */
    protected function inTransaction($stmnts, $params){
        try{
            $connection = $this->openConnection();   
            $prepStmnts = []; 
            $connection->beginTransaction();
            $count  = count($stmnts);
            for ($i = 0; $i < $count; $i++){
                $result = $connection->prepare($stmnts[$i]);
                $result->execute($params[$i]); 
            }
            $connection->commit();
            return true; 
        } 
        catch(\PDOException $e){
            error_log ($e->getMessage());
            $connection->rollBack();
            return false;
        }
    }

    /**
     *  
     *
     */
    protected function multiTransaction($stmnts, $params, $limit){
        try{
            $connection = $this->openConnection();   
            $prepStmnts = []; 
            $connection->beginTransaction();
            $count  = count($stmnts);
            for ($a = 0; $a < $limit; $a++){
                for ($i = 0; $i < $count; $i++){
                    $result = $connection->prepare($stmnts[$i]);
                    $result->execute($params[$i]); 
                }
            }

            $connection->commit();
            $connection = null;    
            return  $result->fetchALL(PDO::FETCH_ASSOC); 
        } 
        catch(Exception $e){
            echo  "Unable to handle request at this time";
            error_log ($e->getMessage());
            $$connection->rollBack();
            return null; 
        }
    }

    protected function inMultiTransaction($stmnts, $params, $limit){
        try{
            $connection = $this->openConnection();   
            $prepStmnts = []; 
            $connection->beginTransaction();
            $count  = count($stmnts);
            for ($a = 0; $a < $limit; $a++){
                for ($i = 0; $i < $count; $i++){
                    $result = $connection->prepare($stmnts[$i]);
                    $result->execute($params[$i]); 
                }
            }

            $connection->commit();
            $connection = null;    
            return true;
        } 
        catch(Exception $e){
            echo  "Unable to handle request at this time";
            error_log ($e->getMessage());
            $$connection->rollBack();
            return false; 
        }
    }

}
