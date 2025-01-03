<?php

require_once './utils/DBWrapper.php';

class Article
{
    private $db;

    public function __construct()
    {
        $this->db = (new DBWrapper())->getDBHandler();
    }

    public function createArticle($title, $coverImg, $date, $smallDescription, $opinionName, $opinionText, $description1, $img1, $description2, $img2, $description3, $img3, $description4)
    {
        $sql = "INSERT INTO article (A_TITLE, A_COVER_IMG, A_DATE, A_SMALL_DESCRIPTION, A_OPINION_NAME, A_OPINION_TEXT, A_DESCRIPTION_1, A_IMG_1, A_DESCRIPTION_2, A_IMG_2, A_DESCRIPTION_3, A_IMG_3, A_DESCRIPTION_4) VALUES (:title, :coverImg, :date, :smallDescription, :opinionName, :opinionText, :description1, :img1, :description2, :img2, :description3, :img3, :description4)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':coverImg', $coverImg, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':smallDescription', $smallDescription, PDO::PARAM_STR);
        $stmt->bindParam(':opinionName', $opinionName, PDO::PARAM_STR);
        $stmt->bindParam(':opinionText', $opinionText, PDO::PARAM_STR);
        $stmt->bindParam(':description1', $description1, PDO::PARAM_STR);
        $stmt->bindParam(':img1', $img1, PDO::PARAM_STR);
        $stmt->bindParam(':description2', $description2, PDO::PARAM_STR);
        $stmt->bindParam(':img2', $img2, PDO::PARAM_STR);
        $stmt->bindParam(':description3', $description3, PDO::PARAM_STR);
        $stmt->bindParam(':img3', $img3, PDO::PARAM_STR);
        $stmt->bindParam(':description4', $description4, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateArticle($id, $title, $coverImg, $date, $smallDescription, $opinionName, $opinionText, $description1, $img1, $description2, $img2, $description3, $img3, $description4)
    {
        $sql = "UPDATE article SET A_TITLE = :title, A_COVER_IMG = :coverImg, A_DATE = :date, A_SMALL_DESCRIPTION = :smallDescription, A_OPINION_NAME = :opinionName, A_OPINION_TEXT = :opinionText, A_DESCRIPTION_1 = :description1, A_IMG_1 = :img1, A_DESCRIPTION_2 = :description2, A_IMG_2 = :img2, A_DESCRIPTION_3 = :description3, A_IMG_3 = :img3, A_DESCRIPTION_4 = :description4 WHERE A_ID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':coverImg', $coverImg, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':smallDescription', $smallDescription, PDO::PARAM_STR);
        $stmt->bindParam(':opinionName', $opinionName, PDO::PARAM_STR);
        $stmt->bindParam(':opinionText', $opinionText, PDO::PARAM_STR);
        $stmt->bindParam(':description1', $description1, PDO::PARAM_STR);
        $stmt->bindParam(':img1', $img1, PDO::PARAM_STR);
        $stmt->bindParam(':description2', $description2, PDO::PARAM_STR);
        $stmt->bindParam(':img2', $img2, PDO::PARAM_STR);
        $stmt->bindParam(':description3', $description3, PDO::PARAM_STR);
        $stmt->bindParam(':img3', $img3, PDO::PARAM_STR);
        $stmt->bindParam(':description4', $description4, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getAllArticles()
    {
        $sql = "SELECT * FROM article ORDER BY A_DATE ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleById($id)
    {
        $sql = "SELECT * FROM article WHERE A_ID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getNextArticleId()
    {
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'article'";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['AUTO_INCREMENT'];
    }

    public function generateArticlesHTML()
    {
        $articles = $this->getAllArticles();
        $html = '';
        foreach ($articles as $article) {
            $html .= '<div class="card">';
            $html .= '<img src="' . htmlspecialchars($article['A_COVER_IMG']) . '" alt="' . htmlspecialchars($article['A_TITLE']) . '">';
            $html .= '<div class="card-content">';
            $html .= '<div><h4>' . htmlspecialchars($article['A_TITLE']) . '</h4>';
            $html .= '<p class="card-description">' . htmlspecialchars($article['A_SMALL_DESCRIPTION']) . '</p></div>';
            $html .= '<div class="button-section">';
            $html .= '<a class="col-12 button" href="article-details.php?id=' . htmlspecialchars($article['A_ID']) . '">Detalhes</a>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }

}
?>