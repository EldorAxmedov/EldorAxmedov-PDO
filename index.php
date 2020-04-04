<?php
class Database{
    private $link;
    public function __construct()
    {
         $this->connect();
    }

    private function connect(){
        $config = require_once 'config.php';
        $dsn='mysql:host='.$config['host'].'; dbname='.$config['db_name'].';charset='.$config['charset'];
        $this->link=new PDO($dsn, $config['username'], $config['password']);
        return $this;
    }
    /**
     * @param $sql
     * @return mixed
     */
    public function execute($sql){
        $sth=$this->link->prepare($sql);
        return $sth->execute();

    }

    /**
     * @param $sql
     * @return array
     */
    public function query($sql){
        $sth=$this->link->prepare($sql);
        $sth->execute();
        $result=$sth->fetchAll(PDO::FETCH_ASSOC);
        if ($result===false){
            return [];


        }
        return $result;
    }
}

$pdo = new Database();
if($pdo->execute("INSERT INTO 'users' SET 'username'='Anisjon', 'password'='2222', 'date'=".time())){
    echo 'connect';
}
else{
    echo 'no connect';
}

echo ini_get("allow_url_fopen");