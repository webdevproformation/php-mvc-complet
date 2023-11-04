<?php 
declare(strict_types=1);

namespace app\core\form ;

use app\core\Model;

/**
 * 
 */
abstract class BaseField 
{


  public Model $model ;
  public string $attribute ;
  
  public function __construct(Model $model, string $attribute)
  {
   
   $this->model = $model;
   $this->attribute = $attribute;
  }

  
  abstract public function renderInput():string ;

  public function __toString(){

    return sprintf('<div class="form-floating mb-3">
          %s
        <label for="floating%s">%s</label>
        <div class="invalid-feedback">
            %s
        </div>
      </div>',
        $this->renderInput() ,
        ucfirst($this->attribute), /*for du label*/
        $this->model->getLabel($this->attribute) , /*texte dans le label*/
        $this->model->getFirstError($this->attribute) /*message d'erreur */
      );
  }
}
