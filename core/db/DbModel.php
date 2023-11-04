<?php 
declare(strict_types=1);

namespace app\core\db ; 

use app\core\Model ;
use app\core\Application ;

/*

https://github.com/thecodeholic/tc-php-mvc-core/blob/master/db/DbModel.php

comme un ORM 
Mapper le RegisterModel avec une table dans la base de données
Base ORM 

doit avoir le nom des tables
 */
abstract class DbModel extends Model{


  abstract public static function tableName(): string ;

  abstract public function attributes() : array ;

  abstract public static function primaryKey() : string ;

  /**
   * save data in the tableName
   * @return [type] [description]
   */
  public function save(){
    $tableName = $this->tableName(); // cas particulier
    $attributes = $this->attributes();

    $params = array_map(fn($attr) => ":$attr"  , $attributes);


    $statement = self::prepare("INSERT INTO $tableName ( " . implode(',', $attributes) . ") VALUES ( " . implode(',', $params) . ")" );
    foreach($attributes as $attribute){
      $statement->bindParam( ":$attribute" , $this->{$attribute});
    }

    $statement->execute();
    return true ;
    
  }

  public static function prepare($sql): \PDOStatement{
    return Application::$APP->db->pdo->prepare($sql);
  }

  public static function findOne(array $where){

    //$tableName = static::class::tableName(); 
    // ou 
    $tableName = static::tableName(); 
    // car appeler User::findOne(["email" => $this->email])
    // dans login de la class LoginForm 
      
    $attributes = array_keys($where);

    $whereStatement = array_map(fn($attr) => " $attr = :$attr "  , $attributes);

    $statement = self::prepare("SELECT *  FROM $tableName WHERE " . implode("AND", $whereStatement));

    foreach ($where as $attribute => $value) {
      $statement->bindParam(":$attribute" , $value);
    }

    $statement->execute();
    return $statement->fetchObject(static::class);
  }
}