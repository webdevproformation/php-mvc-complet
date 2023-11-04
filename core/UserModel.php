<?php 
declare(strict_types=1);

namespace app\core ;

use app\core\db\DbModel ;

/**
 * 
 */
abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string ;
}