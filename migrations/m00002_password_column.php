<?php 

class m00002_password_column{


  public function up(){
    $db = \app\core\Application::$APP->db ;
    $sql = "ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL";
    $db->pdo->exec($sql);
  } 


  public function down(){

    $db = \app\core\Application::$APP->db ;
    $sql = "ALTER TABLE users DROP COLUMN password VARCHAR(512)";
    $db->pdo->exec($sql);
  }
}