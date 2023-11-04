<?php 
declare(strict_types=1);

namespace app\core ;

class Request{

  /**
   * retourne "/contact" depuis l'url http://localhost:1234/contact?id=1
   * retourne "/contact" depuis l'url http://localhost:1234/contact
   * retourne "/" depuis l'url http://localhost:1234
   * @return [type] [description]
   */
  public function getPath() : string {
    $path = $_SERVER['REQUEST_URI'] ?? "/" ;

    $position = strpos($path , "?");

    if($position === false){
      return $path ;
    }
    $path = substr($path , 0 , $position) ;
    return $path ;

  }

  /**
   * return get ou post depuis la superglobale $_SERVER
   * @return [type] [post ou get]
   */
  public function getMethod() :string {
    $method = strtolower($_SERVER['REQUEST_METHOD']); 
    return $method ;
  }

  public function isGet() : bool {
    return $this->getMethod() === 'get';
  }


  public function isPost() : bool{
    return $this->getMethod() === 'post';
  }

  /**
   * samitize les valeurs des super globales $_GET et $_POST avant traitement dans les controllers
   * @return [type] [description]
   */
  public function getBody(){
    $body = [];

    if($this->getMethod() === "get"){
      foreach($_GET as $key => $value){
        $body[$key] = filter_input(INPUT_GET, $key , FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    if($this->getMethod() === "post"){
      foreach($_POST as $key => $value){
        $body[$key] = filter_input(INPUT_POST, $key , FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    return $body ;

  }
}