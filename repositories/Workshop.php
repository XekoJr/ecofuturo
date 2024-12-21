<?php

require_once './utils/DBWrapper.php';

class Workshop
{
    private $db;

    public function __construct()
    {
        $this->db = (new DBWrapper())->getDBHandler();
    }

    public function createWorkshop($title, $imgsrc, $smallDescription, $description, $date)
    {
        $sql = "INSERT INTO workshop (W_TITLE, W_IMG, W_SMALL_DESCRIPTION, W_DESCRIPTION, W_DATE) VALUES (:title, :imgsrc, :smallDescription, :description, :date)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':imgsrc', $imgsrc, PDO::PARAM_STR);
        $stmt->bindParam(':smallDescription', $smallDescription, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateWorkshop($id, $title, $imgsrc, $smallDescription, $description, $date)
    {
        $sql = "UPDATE workshop SET W_TITLE = :title, W_IMG = :imgsrc, W_SMALL_DESCRIPTION = :smallDescription, W_DESCRIPTION = :description, W_DATE = :date WHERE W_ID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':imgsrc', $imgsrc, PDO::PARAM_STR);
        $stmt->bindParam(':smallDescription', $smallDescription, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getWorkshops()
    {
        $sql = "SELECT * FROM workshop ORDER BY W_DATE ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWorkshopById($id)
    {
        $sql = "SELECT * FROM workshop WHERE W_ID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function generateWorkshopsHTML()
    {
        $workshops = $this->getWorkshops();
        $html = '';
        foreach ($workshops as $workshop) {
            $html .= '<div class="card">';
            $html .= '<img src="' . htmlspecialchars($workshop['W_IMG']) . '" alt="' . htmlspecialchars($workshop['W_TITLE']) . '">';
            $html .= '<div class="card-content">';
            $html .= '<div><h4>' . htmlspecialchars($workshop['W_TITLE']) . '</h4>';
            $html .= '<p class="card-description">' . htmlspecialchars($workshop['W_SMALL_DESCRIPTION']) . '</p>';
            $html .= '<p class="card-date">' . htmlspecialchars(date('d-m-Y', strtotime($workshop['W_DATE']))) . '</p></div>';
            $html .= '<div class="button-section">';
            $html .= '<a class="col-12 button" href="workshop-details.php?id=' . htmlspecialchars($workshop['W_ID']) . '" target="_blank">Detalhes</a>';
            $html .= '<a class="col-12 button primary" href="workshop-register.php?id=' . htmlspecialchars($workshop['W_ID']) . '">Inscrever</a>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }
}
