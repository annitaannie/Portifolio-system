<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
requireLogin();

$message = '';
$error = '';

// Handle delete
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM skills WHERE id = ?");
    $stmt->bind_param("i", $id);
    if($stmt->execute()) {
        $message = 'Skill deleted successfully!';
    }
}

// Handle add/edit
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $skill_name = sanitizeInput($_POST['skill_name']);
    $proficiency = intval($_POST['proficiency']);
    $category = sanitizeInput($_POST['category']);
    $display_order = intval($_POST['display_order']);
    
    if(isset($_POST['skill_id']) && !empty($_POST['skill_id'])) {
        $id = intval($_POST['skill_id']);
        $stmt = $conn->prepare("UPDATE skills SET skill_name = ?, proficiency = ?, category = ?, display_order = ? WHERE id = ?");
        $stmt->bind_param("sissi", $skill_name, $proficiency, $category, $display_order, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO skills (skill_name, proficiency, category, display_order) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $skill_name, $proficiency, $category, $display_order);
    }
    
    if($stmt->execute()) {
        $message = 'Skill saved successfully!';
    } else {
        $error = 'Error saving skill.';
    }
}

$skills = $conn->query("SELECT * FROM skills ORDER BY display_order ASC")->fetch_all(MYSQLI_ASSOC);
$edit_skill = null;
if(isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $edit_skill = $conn->query("SELECT * FROM skills WHERE id = $id")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="