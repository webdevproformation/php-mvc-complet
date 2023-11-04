<?php 
declare(strict_types=1);

namespace app\core\db ;

class Database{

  public \PDO $pdo ;

  public function __construct(array $config){

    $dsn = $config["dsn"] ?? '';
    $user = $config["user"] ?? '';
    $password = $config["password"] ?? '';
    try{
      $this->pdo = new \PDO($dsn , $user, $password);
      $this->pdo->setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);
    }catch(\Exception $e){
      
      Application::$APP->response->setStateCode(500);
      echo Application::$APP->view->renderView("_error", ["exception" => $e]);
      die();
    }


  }

  public function applyMigrations(){
    $this->createMigrationsTable();
    $appliedMigrations = $this->getAppliedMigrations();

    $newMigrations = [];

    $files = scandir(Application::$ROOTDIR."/migrations");

    $toApplyMigrations = array_diff($files , $appliedMigrations);

    foreach($toApplyMigrations as $migration){
      if($migration === "." || $migration === ".."){
        continue ;
      }

      require_once Application::$ROOTDIR."/migrations/$migration";
      $className = pathinfo($migration, PATHINFO_FILENAME);

      $instance = new $className();
      $this->log ("🚀 Applying migration $migration");
      $instance->up();
      $this->log ("🆗 Applyed migration $migration");
      $newMigrations[] = $migration;
    }

    if(!empty($newMigrations)){
      $this->saveMigrations($newMigrations);
    }else {
      $this->log ("❌ All migrations are applied");
    }

  }

  public function createMigrationsTable(){
    $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
      id INT AUTO_INCREMENT PRIMARY KEY,
      migration VARCHAR(255),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB;");
  }

  public function getAppliedMigrations(){
    $statement = $this->pdo->prepare("SELECT migration from migrations");
    $statement->execute();
    return $statement->fetchAll(\PDO::FETCH_COLUMN);
  }

  public function saveMigrations(array $migrations){

    $str = implode(',', array_map(fn($m) => "('$m')" , $migrations));

    $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES ". $str);
    $statement->execute();
  }

  public function prepare($sql){
    return $this->pdo->prepare($sql);
  }

  public function log(string $message){
    echo "[" . date("Y-m-d H:i:s") . "] - " .$message . PHP_EOL ;
  }
  

}