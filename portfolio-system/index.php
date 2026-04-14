<?php
$page_title = "Home";
require_once 'includes/config.php';
require_once 'includes/functions.php';
include 'includes/header.php';

$skills = getAllSkills();
$projects = getActiveProjects();
?>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1 class="animate-text">Hi, I'm <span class="highlight">John Doe</span></h1>
            <h2>Full Stack Developer</h2>
            <p>I build amazing web applications that solve real-world problems</p>
            <div class="hero-buttons">
                <a href="projects.php" class="btn btn-primary">View My Work</a>
                <a href="contact.php" class="btn btn-secondary">Contact Me</a>
            </div>
        </div>
    </div>
</section>

<section class="skills-section">
    <div class="container">
        <h2 class="section-title">My Skills</h2>
        <div class="skills-grid">
            <?php foreach(array_slice($skills, 0, 6) as $skill): ?>
            <div class="skill-card">
                <div class="skill-info">
                    <span class="skill-name"><?php echo htmlspecialchars($skill['skill_name']); ?></span>
                    <span class="skill-percent"><?php echo $skill['proficiency']; ?>%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress" style="width: <?php echo $skill['proficiency']; ?>%"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="featured-projects">
    <div class="container">
        <h2 class="section-title">Featured Projects</h2>
        <div class="projects-grid">
            <?php foreach(array_slice($projects, 0, 3) as $project): ?>
            <div class="project-card">
                <?php if($project['image']): ?>
                <img src="assets/images/<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                <?php endif; ?>
                <div class="project-info">
                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($project['description'], 0, 100)) . '...'; ?></p>
                    <div class="project-tech">
                        <?php 
                        $techs = explode(',', $project['technologies']);
                        foreach($techs as $tech): ?>
                        <span class="tech-tag"><?php echo trim(htmlspecialchars($tech)); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <a href="projects.php" class="btn btn-small">Learn More</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>