<?php 

declare(strict_types=1);

namespace app\models ;

use app\core\db\DbModel;

class ContactForm extends DbModel{

  public const MESSAGE_NOT_OPEN = 1;
  public const MESSAGE_OPEN = 2;

  public string $email = "";
  public string $subject = "";
  public string $message = "";
  public string $service = "";
  public int $status = self::MESSAGE_NOT_OPEN;


  public function rules() :array{
      return [
        "email" => [self::RULE_REQUIRED , self::RULE_EMAIL ],
        "subject" => [self::RULE_REQUIRED , [self::RULE_MIN , 'min' => 8] , [self::RULE_MAX , 'max' => 255]],
        "message" => [self::RULE_REQUIRED , [self::RULE_MIN , 'min' => 8] , [self::RULE_MAX , 'max' => 1000]],
        "service" => [self::RULE_REQUIRED]
      ];
  }

  public static function tableName() :string{
    return "contacts";
  }

  public static function primaryKey() :string{
    return "id";
  }

  public function attributes() : array{
    return ["email","subject", "message" , "status"];
  }

  public function labels() : array{
    return [
      "email" => "Votre email",
      "subject" => "Le sujet",
      "message" => "Votre message"
    ];
  }

  public function send(){
    return true ;
  }
}