<?php 

declare(strict_types=1);

namespace app\core\exceptions ;

class ForbiddenException extends \Exception{

  /**
   * override quelques propriétés de la class Exception native de PHP
   */

  protected $message = "You don't have permission to access this page";
  protected $code = 403;


}