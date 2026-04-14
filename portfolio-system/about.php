<?php
$page_title = "About";
require_once 'includes/config.php';
require_once 'includes/functions.php';
include 'includes/header.php';

$about = getAbout();
$skills = getAllSkills();
?>

<section class="about-section">
    <div class="container">
        <h1 class="page-title">About Me</h1>
        
        <div class="about-content">
            <div class="about-image">
                <?php if($about && $about['profile_image']): ?>
                <img src="assets/images/<?php echo htmlspecialchars($about['profile_image']); ?>" alt="Profile">
                <?php else: ?>
                <div class="placeholder-image">
                    <i class="fas fa-user-circle"></i>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="about-text">
                <h2>Who Am I?</h2>
                <?php if($about): ?>
                <p><?php echo nl2br(htmlspecialchars($about['bio'])); ?></p>
                <?php else: ?>
                <p>Welcome to my portfolio! I'm a passionate developer dedicated to creating amazing web experiences.</p>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="skills-section">
            <h2>Technical Skills</h2>
            <div class="skills-grid full-width">
                <?php foreach($skills as $skill): ?>
                <div class="skill-card">
                    <div class="skill-info">
                        <span class="skill-name"><?php echo htmlspecialchars($skill['skill_name']); ?></span>
                        <span class="skill-category"><?php echo htmlspecialchars($skill['category']); ?></span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" style="width: <?php echo $skill['proficiency']; ?>%"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>