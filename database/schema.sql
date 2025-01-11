-- Create database if not exists
CREATE DATABASE IF NOT EXISTS tech_blog;
USE tech_blog;

-- Create articles table
CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    content TEXT,
    image VARCHAR(255),
    category VARCHAR(100)
);

-- Insert sample data with local image paths
INSERT INTO articles (title, content, image, category) VALUES
('Getting Started with Web Development', 'Learn the fundamentals of web development including HTML, CSS, and JavaScript...', 'web-dev.jpg', 'Development'),
('CSS Grid vs Flexbox', 'Understanding the differences between CSS Grid and Flexbox layouts...', 'css-grid.jpg', 'Design'),
('JavaScript Best Practices', 'Modern JavaScript development techniques and best practices...', 'javascript.jpg', 'Programming'); 