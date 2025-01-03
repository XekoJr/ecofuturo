<?php

require_once './utils/DBWrapper.php';

class ManageUsers
{
    private $db;

    public function __construct()
    {
        $this->db = (new DBWrapper())->getDBHandler();
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM user WHERE U_ID = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsernameById($userId)
    {
        $sql = "SELECT U_USERNAME FROM user WHERE U_ID = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function addPointsToUsers($userIds, $points = 10)
    {
        $sql = "UPDATE user SET U_POINTS = U_POINTS + :points WHERE U_ID = :userId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':points', $points, PDO::PARAM_INT);

        foreach ($userIds as $userId) {
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
}
?>