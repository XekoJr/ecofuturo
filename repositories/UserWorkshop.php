<?php

require_once './utils/DBWrapper.php';

class UserWorkshop {
    private $db;

    public function __construct() {
        $this->db = (new DBWrapper())->getDBHandler();
    }

    public function createUserWorkshop($userId, $workshopId, $showed = 0) {
        $sql = "INSERT INTO userworkshop (U_ID, W_ID, UW_SHOWED) VALUES (:userId, :workshopId, :showed)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':workshopId', $workshopId, PDO::PARAM_INT);
        $stmt->bindParam(':showed', $showed, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateUserWorkshop($id, $userId, $workshopId, $showed) {
        $sql = "UPDATE userworkshop SET U_ID = :userId, W_ID = :workshopId, UW_SHOWED = :showed WHERE UW_ID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':workshopId', $workshopId, PDO::PARAM_INT);
        $stmt->bindParam(':showed', $showed, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getUserWorkshopById($id) {
        $sql = "SELECT * FROM userworkshop WHERE UW_ID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserWorkshopsByUserId($userId) {
        $sql = "SELECT * FROM userworkshop WHERE U_ID = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserWorkshopsByWorkshopId($workshopId) {
        $sql = "SELECT * FROM userworkshop WHERE W_ID = :workshopId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':workshopId', $workshopId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUserWorkshops() {
        $sql = "SELECT * FROM userworkshop";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUserWorkshopShowed($userIds, $workshopId)
    {
        $sql = "UPDATE userworkshop SET UW_SHOWED = 1 WHERE U_ID = :userId AND W_ID = :workshopId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':workshopId', $workshopId, PDO::PARAM_INT);

        foreach ($userIds as $userId) {
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function isUserSignedInWorkshop($userId, $workshopId) {
        $sql = "SELECT COUNT(*) FROM userworkshop WHERE U_ID = :userId AND W_ID = :workshopId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':workshopId', $workshopId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function getUserWorkshopsByShowed($userId, $showed) {
        $sql = "SELECT * FROM userworkshop WHERE U_ID = :userId AND UW_SHOWED = :showed";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':showed', $showed, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}