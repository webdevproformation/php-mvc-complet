<?php 
declare(strict_types=1);

namespace app\core ;

class Session{

  protected const FLASH_KEY = "flash_messages";

  public function __construct(){
    session_start();
    $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
    foreach ($flashMessages as $key => &$flashMessage) {
      $flashMessage["remove"] = true;
    }

    $_SESSION[self::FLASH_KEY] = $flashMessages;
   
  }


  public function setFlash($key , $message){
    $_SESSION[self::FLASH_KEY][$key]= [
      "remove" => false , 
      "value" => $message
    ];
  }

  public function getFlash($key){
    return $_SESSION[self::FLASH_KEY][$key]["value"] ?? '' ;
  }

  public function __destruct(){

    // itérate over marked item of the session
    // 
    $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
    foreach ($flashMessages as $key => &$flashMessage) {
      if($flashMessage["remove"] === true){
        unset($flashMessages[$key]);
      }
      
    }
    $_SESSION[self::FLASH_KEY] = $flashMessages;

  }

  public function set($key, $value){
    $_SESSION[$key] = $value ;
  }
  
  public function get($key){
    return $_SESSION[$key] ?? false ;
  }

  public function remove($key){
    if(isset($_SESSION[$key])){
      unset($_SESSION[$key]);
    }
  }


}