<?php 
declare(strict_types=1);

namespace app\core\form ;

use app\core\Model;

/**
 * 
 */
class InputField extends BaseField
{

  public const TYPE_TEXT = "text";
  public const TYPE_PASSWORD = "password";
  public const TYPE_NUMBER = "number";

  public string $type ;

  public function __construct(Model $model, string $attribute)
  {
    $this->type = self::TYPE_TEXT ;
    parent::__construct($model, $attribute);
  }


  public function passwordField(){
    $this->type = self::TYPE_PASSWORD ;
    return $this ;
  }

  public function renderInput() :string{
    return sprintf('<input type="%s" class="form-control %s" id="floating%s" placeholder="%s" name="%s" value="%s">', 
      $this->type , /* le type de l'input par défaut text*/
      $this->model->hasError($this->attribute) ? " is-invalid " : "" ,  /* class si invalid*/
      ucfirst($this->attribute), /*id du champ*/
      $this->attribute, /* placeholder */
      $this->attribute, /* name */
      $this->model->{$this->attribute}, /* value */
    );

  }

}

