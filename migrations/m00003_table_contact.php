<?php 


class m00003_table_contact{
  public function up(){
    $db = \app\core\Application::$APP->db;
    $sql = "CREATE TABLE contacts (
      id INT AUTO_INCREMENT PRIMARY KEY ,
      email VARCHAR(255) NOT NULL ,
      subject VARCHAR(255) NOT NULL ,
      message TEXT NOT NULL , 
      status TINYINT NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      ) ENGINE INNODB";

    $statement = $db->pdo->exec($sql);

  }

  public function down(){
    $db = \app\core\Application::$APP->db;
    $sql = "DROP TABLE contacts";

    $statement = $db->pdo->exec($sql);
  }
}