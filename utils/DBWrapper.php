<?php

require_once 'config.php';

class DBWrapper {
    private $DBH;

    // Connect to db
    public function __construct() {
        global $host, $user, $pwd, $db;
        try {
            $this->DBH = new PDO("mysql:host={$host};dbname={$db};charset=utf8", $user, $pwd);
            $this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $pdoe) {
            echo "Erro na conexão: " . $pdoe->getMessage();
        }
    }

    public function getDBHandler() {
        return $this->DBH;
    }

    
    public function query($sql, $params = []) {
        try {
            $stmt = $this->DBH->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Erro na consulta ao banco de dados: " . $e->getMessage());
        }
    }

    public function getPDO() {
        return $this->DBH;
    }

    public function lastInsertId() {
        return $this->DBH->lastInsertId();
    }

    public function prepare($sql) {
        return $this->DBH->prepare($sql);
    }

}

?>