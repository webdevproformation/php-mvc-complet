<?php 

declare(strict_types=1);

namespace app\core\exceptions ;

class DbException extends \Exception{

  /**
   * override quelques propriétés de la class Exception native de PHP
   */

  protected $message = "problème avec de données";
  protected $code = 500;


}