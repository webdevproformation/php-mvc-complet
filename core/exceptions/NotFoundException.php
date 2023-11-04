<?php 

declare(strict_types=1);

namespace app\core\exceptions ;

class NotFoundException extends \Exception{

  /**
   * override quelques propriétés de la class Exception native de PHP
   */

  protected $message = "Page not found";
  protected $code = 404;


}