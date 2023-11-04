<?php 

class m00001_init {

  public function up(){

    $db = \app\core\Application::$APP->db ;
    $sql = "CREATE TABLE users(
      id INT AUTO_INCREMENT PRIMARY KEY ,
      email VARCHAR(255) NOT NULL ,
      firstname VARCHAR(255) NOT NULL,
      lastname VARCHAR(255) NOT NULL,
      status TINYINT NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB";
    $db->pdo->exec($sql);
  } 


  public function down(){

    $db = \app\core\Application::$APP->db ;
    $sql = "DROP TABLE users" ;
    $db->pdo->exec($sql);
  }
}

//3h04