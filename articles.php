<?php
error_reporting(0);
ini_set('display_errors', 0);

require_once 'config/database.php';
require_once 'templates/header.php';

$query = "SELECT * FROM articles ORDER BY id DESC";
$result = mysqli_query($conn, $query);

// Function to check if image exists
function getImagePath($imageName) {
    $imagePath = 'images/' . $imageName;
    if (file_exists($imagePath)) {
        return $imagePath;
    }
    return 'images/default.jpg';
}
?>

<section class="articles-section">
    <h1>All Articles</h1>
    
    <div class="articles-grid">
        <?php while($article = mysqli_fetch_assoc($result)): ?>
            <article class="article-card">
                <div class="image-wrapper">
                    <img src="<?php echo getImagePath('default.jpg'); ?>" 
                         alt="<?php echo htmlspecialchars($article['title']); ?>"
                         class="article-image">
                </div>
                <div class="article-content">
                    <h2><?php echo htmlspecialchars($article['title']); ?></h2>
                    <p class="article-text"><?php echo htmlspecialchars($article['content']); ?></p>
                    <a href="article.php?id=<?php echo $article['id']; ?>" class="read-more">Read More</a>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?> 