<?php 

declare(strict_types=1);

namespace app\core ;

class View{
  public string $title = "";

  /**
   * Afficher le template front contenant un fichier de template du dossier views
   * @param  string $nomTemplateInView [description]
   * @return [type]                    [description]
   */
  public function renderView( string $nomTemplateInView , $params = []){
    $page_content = $this->renderOnlyView($nomTemplateInView , $params);
    $layout = $this->layoutContent();
    return str_replace("{{content}}", $page_content, $layout);
  } 


  /**
   * Afficher le template front  avec un string comme contenu
   * @param  string $text [description]
   * @return [string]       [description]
   */
  public function renderContent( string $text ):string{
    $layout = $this->layoutContent();
    return str_replace("{{content}}", $text, $layout);
  } 


  public function layoutContent(){

    $layout = Application::$APP->layout ;

    if(Application::$APP->getController()){
      // récupérer la propriété layout du controller sélectionner
      // valeur par défaut front (dans app\controller\Controller.php)
      // dans AuthController modifier de la valeur 
      $layout = Application::$APP->getController()->getLayout();
    }
  
    ob_start();
    include_once Application::$ROOTDIR . "/views/layout/$layout.php";
    return ob_get_clean();
  }

  public function renderOnlyView($tpl , $params){
    
    foreach ($params as $key => $value) {
      $$key = $value ;
    }

    ob_start();
    include_once Application::$ROOTDIR . "/views/$tpl.php";
    return ob_get_clean();
  }
}