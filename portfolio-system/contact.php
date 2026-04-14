<?php
$page_title = "Contact";
require_once 'includes/config.php';
require_once 'includes/functions.php';

$message_sent = false;
$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $subject = sanitizeInput($_POST['subject'] ?? '');
    $message = sanitizeInput($_POST['message'] ?? '');
    
    if(empty($name) || empty($email) || empty($message)) {
        $error = 'Please fill in all required fields.';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        if(saveMessage($name, $email, $subject, $message)) {
            $message_sent = true;
        } else {
            $error = 'An error occurred. Please try again.';
        }
    }
}

include 'includes/header.php';
?>

<section class="contact-section">
    <div class="container">
        <h1 class="page-title">Contact Me</h1>
        
        <div class="contact-wrapper">
            <div class="contact-info">
                <h2>Let's Connect</h2>
                <p>I'm always interested in hearing about new projects and opportunities.</p>
                
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h3>Email</h3>
                        <p>john.doe@example.com</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <h3>Phone</h3>
                        <p>+1 (555) 123-4567</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h3>Location</h3>
                        <p>San Francisco, CA</p>
                    </div>
                </div>
                
                <div class="social-connect">
                    <h3>Follow Me</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-wrapper">
                <?php if($message_sent): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    Thank you! Your message has been sent successfully.
                </div>
                <?php endif; ?>
                
                <?php if($error): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>
                
                <form method="POST" action="" class="contact-form" id="contactForm">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>