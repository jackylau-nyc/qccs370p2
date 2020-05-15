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
          
        } catch(PDOException $e){
            $connection = null; 
            print "Error!: " . $e->getMessage();
            die();
        }
        return $connection;            
    }
    /**
     * 
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
            $pdo->rollBack();
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
            $pdo->rollBack();
            return null; 
        }
    }

}
