<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - <?php echo $page_title ?? 'Home'; ?></title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="<?php echo SITE_URL; ?>" class="logo"><?php echo SITE_NAME; ?></a>
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="<?php echo SITE_URL; ?>index.php">Home</a></li>
                <li><a href="<?php echo SITE_URL; ?>about.php">About</a></li>
                <li><a href="<?php echo SITE_URL; ?>projects.php">Projects</a></li>
                <li><a href="<?php echo SITE_URL; ?>contact.php">Contact</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="<?php echo SITE_URL; ?>admin/dashboard.php" class="admin-link"><i class="fas fa-cog"></i> Admin</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <main>