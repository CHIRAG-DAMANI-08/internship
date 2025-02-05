<?php
require_once 'config/database.php';
require_once 'templates/header.php';
?>

<section class="contact-section">
    <h1>Contact Us</h1>
    <div class="contact-form">
        <form action="process_contact.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            
            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?> 