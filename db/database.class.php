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
        $SQL = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";";
        try {
            $this->pdo = new \PDO($SQL, $this->user, $this->password);
            $this->pdo->exec("SET NAMES '" . $this->charset . "' COLLATE'" . $this->collation . "'");
            $this->pdo->exec("SET CHARACTER SET '" . $this->charset . "'");
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        } catch (\PDOException $error) {
            die("veri tabani baglantisi kurulamadi " . $error->getMessage());
        }
    }
    //it creates query of functions to avoid repetitive code.
    private function publicQuery($query, $params = null)
    {
        if (is_null($params)) {
            $this->stmt = $this->pdo->query($query);
        } else {
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute($params);
        }
        return $this->stmt;
    }
    //fetch all rows
    public function getRows($query, $params = null)
    {
        try {
            return $this->publicQuery($query, $params)->fetchAll();
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
    //fetch specific rows
    public function getRow($query, $params = null)
    {
        try {
            return $this->publicQuery($query, $params)->fetch();
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
    //fetch single column
    public function getColumn($query, $params = null)
    {
        try {
            return $this->publicQuery($query, $params)->fetchColumn();
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
    //add data
    public function insert($query, $params = null)
    {
        try {
            $this->publicQuery($query, $params);
            return $this->pdo->lastInsertId();
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
    //update
    public function update($query, $params = null)
    {
        try {
            return $this->publicQuery($query, $params)->rowCount();
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
    //delete
    public function delete($query, $params = null)
    {
        return $this->update($query, $params);
    }
    //create database
    public function CreateDB($query)
    {
        $CreateDatabase = $this->pdo->query($query . ' CHARACTER SET ' . $this->charset . ' COLLATE ' . $this->collation);
        return $CreateDatabase;
    }
    //limit
    public function limit($query, $par1 = 1, $par2 = NULL)
    {
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->bindParam(1, $par1, \PDO::PARAM_INT);
        if (!is_null($par2)) {
            $this->stmt->bindParam(2, $par2, \PDO::PARAM_INT);
        }
        $this->stmt->execute();
        return $this->stmt->fetchAll();
    }
    //create table
    public function CreateTable($query)
    {
        $CreateTable = $this->pdo->query($query);
        return $CreateTable;
    }
    //table operations
    public function TableOperations($query, $queryTwo)
    {
        $table = $this->pdo->query($query, $queryTwo);
        return $table;
    }
    function __destruct()
    {
        $this->pdo = NULL;
    }
}
