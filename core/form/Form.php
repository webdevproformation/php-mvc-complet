<?php 
declare(strict_types=1);

namespace app\core\form;

use app\core\Model ;


class Form{

 public static function begin($action , $method = "post"){
  echo sprintf('<form action="%s" method="%s">' , $action ,$method ) ;
  return new Form();
 }

 public static function end(){
  echo '</form>';
 }

 public function field(Model $model , $attribute){
  return new InputField($model, $attribute);
 }

  public function textarea(Model $model , $attribute){
  return new TextareaField($model, $attribute);
 }

  public function select(Model $model , $attribute , $values){
  return new SelectField($model, $attribute , $values);
 }

}