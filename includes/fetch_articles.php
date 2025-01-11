<?php
class Article {
    private $db;
    
    public function __construct() {
        $config = require __DIR__ . '/../config/database.php';
        
        try {
            $this->db = new PDO(
                "mysql:host={$config['mysql']['host']};dbname={$config['mysql']['dbname']}",
                $config['mysql']['username'],
                $config['mysql']['password'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    public function getArticles($filter = 'latest', $page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit;
        
        $query = "SELECT * FROM articles ";
        $params = [];
        
        switch($filter) {
            case 'popular':
                $query .= "ORDER BY views DESC ";
                break;
            case 'editors_pick':
                $query .= "WHERE is_featured = 1 ";
                break;
            default:
                $query .= "ORDER BY published_date DESC ";
        }
        
        $query .= "LIMIT :limit OFFSET :offset";
        
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
    
    public function displayArticles() {
        // Get filter and page from URL parameters
        $filter = $_GET['filter'] ?? 'latest';
        $page = (int)($_GET['page'] ?? 1);
        
        $articles = $this->getArticles($filter, $page);
        
        foreach($articles as $article) {
            echo '<div class="article-card">';
            echo '<img src="' . htmlspecialchars($article['image_url']) . '" alt="' . htmlspecialchars($article['title']) . '">';
            echo '<div class="article-content">';
            echo '<h2>' . htmlspecialchars($article['title']) . '</h2>';
            echo '<p>' . htmlspecialchars($article['excerpt']) . '</p>';
            echo '<div class="article-meta">';
            echo '<span class="author">By ' . htmlspecialchars($article['author']) . '</span>';
            echo '<span class="date">' . date('M d, Y', strtotime($article['published_date'])) . '</span>';
            echo '</div></div></div>';
        }
    }
}

// Normal article display
$articleManager = new Article();
$articleManager->displayArticles();
?> 