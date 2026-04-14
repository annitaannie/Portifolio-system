<?php
include '../includes/auth.php';
include '../includes/config.php';

if(isset($_POST['add'])){
    mysqli_query($conn,"INSERT INTO projects(title,description)
    VALUES('$_POST[title]','$_POST[description]')");
}
?>
<h2>Manage Projects</h2>
<form method="post">
<input name="title" placeholder="Title">
<textarea name="description"></textarea>
<button name="add">Add</button>
</form>
<hr>
<?php
$q=mysqli_query($conn,"SELECT * FROM projects");
while($r=mysqli_fetch_assoc($q)){
    echo "<p>{$r['title']} - {$r['description']}</p>";
}
?>
