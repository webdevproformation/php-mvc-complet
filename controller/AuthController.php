<?php 


namespace app\controller ;

use app\core\Controller ; 
use app\core\Request ; 
use app\core\Response ; 
use app\models\User;
use app\models\LoginForm;
use app\core\Application;
use app\core\middlewares\AuthMiddleware;

class AuthController extends Controller{

  public function __construct(){

    /**
     * les middlesware sont des traitements qui sont exécutés 
     * entre la requête et le controlleur
     * restreindre l'accès au controlleur 
     * modifier le return d'une action du controller 
     */
    $this->registerMiddleware(new AuthMiddleware(["profile"]));
  }


  public function login(Request $request , Response $response){

    $loginModel = new LoginForm();
    
    if($request->isPost()){
      $loginModel->loadData($request->getBody());
 
      if($loginModel->validate() && $loginModel->login()){
       
        $response->redirect("/");
        die();
      }

    }

    $this->setLayout("auth");
    return $this->render("login" , [
        "model" =>  $loginModel
      ]);
  }



  public function register(Request $request, Response $response){

    $userModel = new User();

    if($request->isPost()){

      $userModel->loadData($request->getBody());

      if( $userModel->validate() && $userModel->save()){
        Application::$APP->session->setFlash( "success" ,"user add in db");
        $response->redirect("/");
        die();
      }
     
    }
    $this->setLayout("auth");
    return $this->render("register" , [
        "model" =>  $userModel
      ]);
  }

  public function logout(Request $request, Response $response){
    Application::$APP->logout();
    Application::$APP->session->setFlash( "success" ,"vous êtes déconnecté désormais");
    $response->redirect("/");
  }

  public function profile (){
    return $this->render("profile");
  }

}