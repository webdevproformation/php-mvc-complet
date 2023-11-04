<?php 
declare(strict_types=1);

namespace app\core ;

class Response{


  public function setStateCode(int $code){
    http_response_code($code);
  }

  public function redirect(string $path){
    header("Location: $path");
  }
}