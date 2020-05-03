<?php
namespace routing;


class Router{
    private $request;
    private $supportedHttpMethods = array("GET", "POST");

    function __construct(IRequest $request){
       $this->request = $request;
    }
    
    function __call($name, $args){
        $this->isInvoked($args);
        list($route, $method) = $args;
        $this->validateVerb($name);
        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    /*
    *
    */
    function resolve(){
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $formatedRoute = $this->formatRoute($this->request->requestUri);
        
        $method = $methodDictionary[$formatedRoute] ?? null;
        if(is_null($method)){
            $this->defaultMethodHandler();
        }else{
            echo call_user_func_array($method, array($this->request));
        }
    }

    /**
     * Removes trailing forward slashes from the right of the route.
     * @param route (string)
     */
    private function formatRoute($route){
       $result = rtrim($route, '/');
       if ($result === ''){
          return '/';
        }
        return $result;
    }

    private function invalidMethodHandler(){
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function defaultMethodHandler(){
        http_response_code(404);
        require __DIR__ . '/../../resources/views/404.php'; 
    }

    function __destruct(){
        $this->resolve();
    }
 
   /****************************************************************************************************
    ********************************************** Helper **********************************************
    ****************************************************************************************************/
    /**
     * See if all arguments are present. 
     * @param args (array) 
     */
    private function isInvoked($args){
        if(is_null($args[0]) || is_null($args[1])){
            echo call_user_func_array($args[1], array($this->request));
            exit; 
        }
    }
    /**
     * Checks whether the http method belongs to the list of supported methods.  
     * @param name (string) e.g. PUT, GET, POST, DELETE etc.  
     */
     private function validateVerb($name){
        if(!in_array(strtoupper($name), $this->supportedHttpMethods)){
            $this->invalidMethodHandler();
            exit;
        }
    }
}
