<?php

require_once './utils/DBWrapper.php';

class UserGame {
    private $db;

    public function __construct() {
        $this->db = (new DBWrapper())->getDBHandler();
    }

    public function insertUserGame($userId, $gameId, $points) {
        $sql = "INSERT INTO usergame (U_ID, G_ID, UG_POINTS) VALUES (:userId, :gameId, :points)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $stmt->bindParam(':points', $points, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteUserGame($userId, $gameId) {
        $sql = "DELETE FROM usergame WHERE U_ID = :userId AND G_ID = :gameId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getUserGamesByUserId($userId) {
        $sql = "SELECT * FROM usergame WHERE U_ID = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserGamesByGameId($gameId) {
        $sql = "SELECT * FROM usergame WHERE G_ID = :gameId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserGamesByGameIdOrderedByPoints($gameId) {
        $sql = "SELECT * FROM usergame WHERE G_ID = :gameId ORDER BY UG_POINTS DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMaxPointsByUserId($userId) {
        $sql = "SELECT G_ID, COALESCE(MAX(UG_POINTS), 0) as max_points FROM usergame WHERE U_ID = :userId GROUP BY G_ID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}