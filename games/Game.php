<?php

require_once './utils/DBWrapper.php';

class Game {
    private $db;
    private $table = 'game';

    public function __construct() {
        $this->db = (new DBWrapper())->getDBHandler();
    }

    public function getAllGames() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGameById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE G_ID = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getGameNameById($id) {
        $query = "SELECT G_NAME FROM " . $this->table . " WHERE G_ID = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function createGame($name) {
        $query = "INSERT INTO " . $this->table . " (G_NAME) VALUES (:name)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateGame($id, $name) {
        $query = "UPDATE " . $this->table . " SET G_NAME = :name WHERE G_ID = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteGame($id) {
        $query = "DELETE FROM " . $this->table . " WHERE G_ID = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>