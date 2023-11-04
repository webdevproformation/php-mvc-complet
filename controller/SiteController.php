<?php

namespace app\controller ;


use app\core\Application ; 
use app\core\Controller ;
use app\core\Request ;
use app\core\Response ;
use app\models\ContactForm;

class SiteController extends Controller{

  /*public function handleContact(Request $request){ 
     dans le call_user_func() de resolve() dans le router 

    //$data = Application::$APP->request->getBody();

    $data = $request->getBody();

    return "Handling submitted data";
  }*/

   public function home(){
    $params = [
      "sousTitre" => "je suis le sous titre"
    ];
    return $this->render("home" , $params);
  }

  public function contact(Request $request, Response $response){

    $contactFormModel = new ContactForm();

    if($request->isPost()){
        $contactFormModel->loadData($request->getBody());

        if($contactFormModel->validate() && 
           $contactFormModel->save() && 
           $contactFormModel->send()
         ){
          Application::$APP->session->setFlash("success", "Thx you for the message");
          $response->redirect("/contact");
        }
    }


    //return Application::$APP->router->renderView("contact");
    return $this->render("contact" , [ "model" => $contactFormModel ]);
  }

}