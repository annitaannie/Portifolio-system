<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
requireLogin();

$message = '';
$error = '';

$about = $conn->query("SELECT * FROM about LIMIT 1")->fetch_assoc();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bio = sanitizeInput($_POST['bio']);
    $profile_image = $about['profile_image'] ?? '';
    
    // Handle image upload
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $uploaded_image = uploadImage($_FILES['profile_image'], '../assets/images/');
        if($uploaded_image) {
            $profile_image = $uploaded_image;
        }
    }
    
    if($about) {
        $stmt = $conn->prepare("UPDATE about SET bio = ?, profile_image = ? WHERE id = ?");
        $stmt->bind_param("ssi", $bio, $profile_image, $about['id']);
    } else {
        $stmt = $conn->prepare("INSERT INTO about (bio, profile_image) VALUES (?, ?)");
        $stmt->bind_param("ss", $bio, $profile_image);
    }
    
    if($stmt->execute()) {
        $message = 'About section updated successfully!';
        $about = $conn->query("SELECT * FROM about LIMIT 1")->fetch_assoc();
    } else {
        $error = 'Error updating about section.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage About - Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="admin-panel">
    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-cog"></i> Admin</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php"><i class="fas fa-dashboard"></i> Dashboard</a>
                <a href="manage-about.php" class="active"><i class="fas fa-user"></i> About</a>
                <a href="manage-skills.php"><i class="fas fa-code"></i> Skills</a>
                <a href="manage-projects.php"><i class="fas fa-folder"></i> Projects</a>
                <a href="manage-messages.php"><i class="fas fa-envelope"></i> Messages</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Manage About Section</h1>
            </div>
            
            <?php if($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <?php if($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" enctype="multipart/form-data" class="admin-form">
                <div class="form-group">
                    <label>Profile Image</label>
                    <?php if($about && $about['profile_image']): ?>
                    <div class="current-image">
                        <img src="../assets/images/<?php echo htmlspecialchars($about['profile_image']); ?>" alt="Profile" style="max-width: 150px;">
                        <p>Current image</p>
                    </div>
                    <?php endif; ?>
                    <input type="file" name="profile_image" accept="image/*">
                </div>
                
                <div class="form-group">
                    <label>Bio / About Text</label>
                    <textarea name="bio" rows="10" required><?php echo htmlspecialchars($about['bio'] ?? ''); ?></textarea>
                </div>
                
                <button type="submit" class="btn-submit">Save Changes</button>
            </form>
        </main>
    </div>
    <script src="../assets/js/admin.js"></script>
</body>
</html>