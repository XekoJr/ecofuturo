<?php

require_once './utils/DBWrapper.php';

class Recycling {
    private $db;

    public function __construct() {
        $this->db = (new DBWrapper())->getDBHandler();
    }

    public function getRandomObjects($limit = 5) {
        $sql = "SELECT * FROM object ORDER BY RAND() LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function generateObjectsHTML($limit = 5) {
        $objects = $this->getRandomObjects($limit);
        $html = '<div class="objects">';
        foreach ($objects as $object) {
            $html .= '<img src="' . htmlspecialchars($object['O_SRC']) . '" class="object" draggable="true" data-type="' . htmlspecialchars($object['O_TYPE']) . '" alt="' . htmlspecialchars($object['O_ALT']) . '">';
        }
        $html .= '</div>';
        return $html;
    }

}