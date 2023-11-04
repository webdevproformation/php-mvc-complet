<?php 
declare(strict_types=1);

namespace app\core;


use app\core\exceptions\NotFoundException;

class Router{

  /**
   * tableau associatif des routes créées 
   * dans le fichier index.php
   * [ "get" => [ "/" => callback , "/contact" => callback ], "post" => [...] ]
   * @var array
   */
  protected array $routes = [];

  public Request $request ;
  public Response $response ;


  public function __construct(Request $request , Response $response){
    $this->request = $request ;
    $this->response = $response ;
  }

  /**
   * méthode permettant d'alimenter la propriété $routes
   * @param  [type] $path     [description]
   * @param  [type] $callback [description]
   * @return [type]           [description]
   */
  public function get($path , $callback){
    $this->routes["get"][$path] = $callback;
  }


   public function post($path , $callback){
    $this->routes["post"][$path] = $callback;
  }

  /**
   * déterminer the current path (url path) ET quel est la méthode courante
   * @return [type] [description]
   */
  public function resolve(){

    $path = $this->request->getPath();
    $method = $this->request->getMethod();
  
    $callbackAExecuter = $this->routes[$method][$path] ?? false;

    if($callbackAExecuter === false){
      //$this->response->setStateCode(404);
      //return $this->renderView("404");
      throw new NotFoundException();  
    }

    if(is_string($callbackAExecuter)){
      return Application::$APP->view->renderView($callbackAExecuter);
    }

    if(is_array($callbackAExecuter)){
      // initialiser le controller définit dans le router
      /**
       * @var \app\core\Controller $instanceDuController
       */
      $instanceDuController = new $callbackAExecuter[0]();
      // le passer à Application 
      Application::$APP->setController($instanceDuController); 

      Application::$APP->controller->action = $callbackAExecuter[1];
      
      $callbackAExecuter[0] = $instanceDuController ;

      foreach ($instanceDuController->getMiddlewares() as $middleware) {
        $middleware->execute();
      }

    }

    return call_user_func($callbackAExecuter , $this->request , $this->response);

  }

  

}