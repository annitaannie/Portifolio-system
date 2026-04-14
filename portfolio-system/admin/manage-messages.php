<?php
include '../includes/auth.php';
include '../includes/config.php';
$q=mysqli_query($conn,"SELECT * FROM messages");
while($r=mysqli_fetch_assoc($q)){
    echo "<p><b>{$r['name']}</b> : {$r['message']}</p>";
}
?>
