<?php 
declare(strict_types=1);

namespace app\models ;

use app\core\UserModel ; 

/*
modification du extends de Model à
DbModel
 */

class User extends UserModel{

  public const STATUS_INACTIVE = 1;
  public const STATUS_ACTIVE = 2;
  public const STATUS_DELETED = 3;

  public string $firstname ="";
  public string $lastname ="";
  public string $email ="";
  public string $password ="";
  public int $status = self::STATUS_INACTIVE;
  public string $confirmPassword ="" ;


  public function save(){
    $this->status = self::STATUS_INACTIVE;
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    return parent::save();
    
  }

  public function rules() :array{
      return [
        "firstname" => [self::RULE_REQUIRED],
        "lastname" => [self::RULE_REQUIRED],
        "email" => [self::RULE_REQUIRED , self::RULE_EMAIL , 
            [
            self::RULE_UNIQUE , 
            "class" =>  self::class ,
            "attribute" => "email"
            ]
        ],
        "password" => [self::RULE_REQUIRED , [self::RULE_MIN , 'min' => 8] , [self::RULE_MAX , 'max' => 255]],
        "confirmPassword" => [self::RULE_REQUIRED , [self::RULE_MATCH , 'match' => 'password']],
      ];
  }
  /*
  vient d'une méthode abstraite de DbModel
  et va faire le mapping avec la table users de la base de données
   */
  public static function tableName() :string{
    return "users";
  }

  public static function primaryKey() :string{
    return "id";
  }

  public function attributes() : array{
    return ["firstname","lastname", "email" , "password" , "status"];
  }

  public function labels() : array{
    return [
      "firstname" => "Votre Prénom",
      "lastname" => "Votre Nom", 
      "email" => "Votre email",
      "password" => "Mot de passe",
      "confirmPassword" => "veuillez confirmer votre mot de passe"
    ];
  }

   public function getDisplayName() : string{
      return "{$this->firstname} {$this->lastname}";
    }

}