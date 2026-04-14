<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
requireLogin();

$page_title = "Dashboard";

// Get statistics
$stats = [];
$stats['total_projects'] = $conn->query("SELECT COUNT(*) as count FROM projects")->fetch_assoc()['count'];
$stats['total_messages'] = $conn->query("SELECT COUNT(*) as count FROM messages")->fetch_assoc()['count'];
$stats['unread_messages'] = $conn->query("SELECT COUNT(*) as count FROM messages WHERE is_read = 0")->fetch_assoc()['count'];
$stats['active_projects'] = $conn->query("SELECT COUNT(*) as count FROM projects WHERE status = 'active'")->fetch_assoc()['count'];

// Get recent messages
$recent_messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?php echo SITE_NAME; ?></title>
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
                <a href="dashboard.php" class="active"><i class="fas fa-dashboard"></i> Dashboard</a>
                <a href="manage-about.php"><i class="fas fa-user"></i> About</a>
                <a href="manage-skills.php"><i class="fas fa-code"></i> Skills</a>
                <a href="manage-projects.php"><i class="fas fa-folder"></i> Projects</a>
                <a href="manage-messages.php"><i class="fas fa-envelope"></i> Messages</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-folder"></i>
                    <div class="stat-info">
                        <h3><?php echo $stats['total_projects']; ?></h3>
                        <p>Total Projects</p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-code"></i>
                    <div class="stat-info">
                        <h3><?php echo $stats['active_projects']; ?></h3>
                        <p>Active Projects</p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-envelope"></i>
                    <div class="stat-info">
                        <h3><?php echo $stats['total_messages']; ?></h3>
                        <p>Total Messages</p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-envelope-open"></i>
                    <div class="stat-info">
                        <h3><?php echo $stats['unread_messages']; ?></h3>
                        <p>Unread Messages</p>
                    </div>
                </div>
            </div>
            
            <div class="recent-section">
                <h2>Recent Messages</h2>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($recent_messages as $message): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($message['name']); ?></td>
                                <td><?php echo htmlspecialchars($message['email']); ?></td>
                                <td><?php echo htmlspecialchars($message['subject']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($message['created_at'])); ?></td>
                                <td>
                                    <?php if($message['is_read']): ?>
                                    <span class="badge success">Read</span>
                                    <?php else: ?>
                                    <span class="badge warning">Unread</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="../assets/js/admin.js"></script>
</body>
</html>