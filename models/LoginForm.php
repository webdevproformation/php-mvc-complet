<?php 
declare(strict_types=1);

namespace app\models ;

use app\core\Model; 
use app\core\Application;
use app\models\User;

class LoginForm extends Model {

  public string $email ="";
  public string $password ="";


  public function login() :bool {

    $user = User::findOne(["email" => $this->email]);

    if(!$user){
      $this->addError("email" , "User does not exist");
      return false ;
    }

    if(!password_verify($this->password, $user->password)){
      $this->addError("password" , "password incorrect");
      return false ;
    }
    
    return Application::$APP->login($user);
  }

  public function rules() :array{
      return [
        "email" => [self::RULE_REQUIRED , self::RULE_EMAIL ],
        "password" => [self::RULE_REQUIRED , [self::RULE_MIN , 'min' => 8] , [self::RULE_MAX , 'max' => 255]],
      ];
  }

  
  public function labels() : array{
    return [
      "email" => "Votre email",
      "password" => "Mot de passe"
    ];
  }
}