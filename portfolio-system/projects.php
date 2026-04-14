<?php
$page_title = "Projects";
require_once 'includes/config.php';
require_once 'includes/functions.php';
include 'includes/header.php';

$projects = getActiveProjects();
?>

<section class="projects-section">
    <div class="container">
        <h1 class="page-title">My Projects</h1>
        
        <div class="projects-filter">
            <button class="filter-btn active" data-filter="all">All Projects</button>
            <button class="filter-btn" data-filter="web">Web Apps</button>
            <button class="filter-btn" data-filter="mobile">Mobile</button>
            <button class="filter-btn" data-filter="backend">Backend</button>
        </div>
        
        <div class="projects-grid">
            <?php foreach($projects as $project): ?>
            <div class="project-card" data-category="web">
                <?php if($project['image']): ?>
                <img src="assets/images/<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                <?php else: ?>
                <div class="project-image-placeholder">
                    <i class="fas fa-code"></i>
                </div>
                <?php endif; ?>
                <div class="project-info">
                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p><?php echo htmlspecialchars($project['description']); ?></p>
                    <div class="project-tech">
                        <?php 
                        $techs = explode(',', $project['technologies']);
                        foreach($techs as $tech): ?>
                        <span class="tech-tag"><?php echo trim(htmlspecialchars($tech)); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="project-links">
                        <?php if($project['project_url']): ?>
                        <a href="<?php echo htmlspecialchars($project['project_url']); ?>" target="_blank" class="btn btn-small">Live Demo</a>
                        <?php endif; ?>
                        <?php if($project['github_url']): ?>
                        <a href="<?php echo htmlspecialchars($project['github_url']); ?>" target="_blank" class="btn btn-small btn-outline">GitHub</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>