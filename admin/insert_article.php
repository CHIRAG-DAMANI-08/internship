<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    
    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image_name = $_FILES['image']['name'];
        $target_path = "../images/" . $image_name;
        
        // Move uploaded file to images directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO articles (title, content, image, category) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $title, $content, $image_name, $category);
            $stmt->execute();
        }
    }
}
?> 