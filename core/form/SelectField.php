<?php 
declare(strict_types=1);

namespace app\core\form ;

use app\core\Model;

/**
 * 
 */
class SelectField extends BaseField
{

  public array $optionValues ; 

  public function __construct(Model $model, string $attribute , array $optionValues)
  {
    $this->optionValues = $optionValues ;
    parent::__construct($model, $attribute);


  }

  public function renderInput() :string{
    return sprintf(' <select class="form-select %s" id="floating%s" name="%s">
  <option value="">Open this select menu</option>
  %s
</select>', 
      $this->model->hasError($this->attribute) ? " is-invalid " : "" ,  /* class si invalid*/
      ucfirst($this->attribute), /*id du champ*/
      $this->attribute, /* name */
      $this->generateOptions($this->model->{$this->attribute})
      //$this->model->{$this->attribute}, /* value */
    );

  }

  public function generateOptions($selectedValue) :string{

    $html = "";
    foreach ($this->optionValues as $value) {
        if($value === $selectedValue){
          $html .= "<option value='$value' selected>$value</option>";
        }else {

          $html .= "<option value='$value'>$value</option>";
        }
    }
    return $html;
  }

}