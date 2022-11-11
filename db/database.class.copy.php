<?php

namespace project\db;

class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'trainingdb';
    private $charset = 'UTF8';
    private $collation = 'utf8_general_ci';
    private $pdo = null;
    private $stmt = null;
    public function __construct()
    {
        $this->ConnectDB();
    }
    private function ConnectDB()
    {
        //BAGALNTI START
        $SQL = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";";
        //veri tabanini php ile oluşturacaksan aşağıdaki host bilgisi yeterli
        // $SQL = "mysql:host=" . $this->host;
        try {
            $this->pdo = new \PDO($SQL, $this->user, $this->password);
            $this->pdo->exec("SET NAMES '" . $this->charset . "' COLLATE'" . $this->collation . "'");
            $this->pdo->exec("SET CHARACTER SET '" . $this->charset . "'");
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            //VERİ TABANINDAN VERİYİ OBJE OLARAK ALMAK İÇİN
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            //FETCH_OBJ veri tabında ki verileri nesne oalrak getirir. istersen FETCH_NUM yapıp array olarak alabilirsin
            //FETCH_ASSOC da dizi olarak veri almanı sağlar. fakat artan indis numarasıyla değil key value olarak verir
            //BAGALNTI END
        } catch (\PDOException $error) {
            die("veri tabani baglantisi kurulamadi " . $error->getMessage());
        }
    }
    public function getTable($query, $params = null)
    {
        if (is_null($params)) {
            $this->stmt = $this->pdo->query($query);
        } else {
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute($params);
        }
        return $this->stmt;
    }
    public function CreateDB($query)
    {
        $CreateDatabase = $this->pdo->query($query . ' CHARACTER SET ' . $this->charset . ' COLLATE ' . $this->collation);
        return $CreateDatabase;
    }
    public function CreateTable($query)
    {
        $CreateTable = $this->pdo->query($query);
        return $CreateTable;
    }
    public function TableOperations($query, $queryTwo)
    {
        $table = $this->pdo->query($query, $queryTwo);
        return $table;
    }
    function __destruct()
    {
        //DATABASE BAGLANTİSİ KAPATMA
        $this->pdo = NULL;
    }
}



//fetchAll(); bütün veritabanı satırlarına etki etmek için