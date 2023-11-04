<?php 
declare(strict_types=1);

namespace app\core\form ;

use app\core\Model;

/**
 * 
 */
class TextareaField extends BaseField
{

  public function __construct(Model $model, string $attribute)
  {
    parent::__construct($model, $attribute);
  }

  public function renderInput() :string{
    return sprintf(' <textarea class="form-control %s" placeholder="%s" id="floating%s" name="%s" style="height:200px">%s</textarea>', 
      $this->model->hasError($this->attribute) ? " is-invalid " : "" ,  /* class si invalid*/
      $this->attribute, /* placeholder */
      ucfirst($this->attribute), /*id du champ*/
      $this->attribute, /* name */
      $this->model->{$this->attribute}, /* value */
    );

  }

}