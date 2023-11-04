<?php 
declare(strict_types=1);

namespace app\core;

use app\core\db\Database;
use app\core\db\DbModel;

/*
https://github.com/thecodeholic/tc-php-mvc-core/blob/master/Application.php

 */

class Application{

  public string $layout = "front";

  public ?string $userClass ;
  public Router $router ;
  public Request $request ;
  public static string $ROOTDIR ;
  public Response $response ;
  public static Application $APP ;
  public ?Controller $controller = null ;
  public Database $db ;
  public Session $session ;
  public ?DbModel $user = null; /**/
  public View $view ;

  public function __construct(string $rootDir, array $config){

    self::$APP = $this; /* permet d'accéder Application et toutes ses propriétés partout */
    self::$ROOTDIR = $rootDir ; 
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request , $this->response);
  
    $this->view = new View();
    $this->session = new Session();
    $this->db = new Database($config["db"]);


    $this->userClass = $config["userClass"] ?? null;

    $primaryValue = $this->session->get("user");

    if($primaryValue){
      $primaryKey = $this->userClass::primaryKey() ;
      $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
    }
  }

  public function run():void{
    try{
      echo $this->router->resolve();
    } catch(\Exception $e){
      $code = (int)$e->getCode();
      $this->response->setStateCode($code);
      echo $this->view->renderView("_error", ["exception" => $e]);
    }
  }

  public function getController() : Controller | null{
    return $this->controller;
  }

  public function setController(Controller $controller):void {
    $this->controller = $controller ;
  }

  /**
   * Enregistrer l id de l'utilisateur dans la $_SESSION
   * et faire une requete SELECT pour aller chercher les 
   * infos du User en bdd (et non stocker tout le profil 
   * dans la SESSION)
   * @param  DbModel $user [description]
   * @return [type]        [description]
   */
  public function login(DbModel $user) :bool{
    $this->user = $user ;
    $primaryKey = $user->primaryKey() ;
    $primaryValue = $user->{$primaryKey};
    $this->session->set("user", $primaryValue);

    return true;
  }

  public function logout() :void{
    $this->user = null ;
    $this->session->remove("user");
  }

  public static function isGuest(){
    return !self::$APP->user;
  }


}