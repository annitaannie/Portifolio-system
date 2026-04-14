<?php
function getAbout() {
    global $conn;
    $query = "SELECT * FROM about LIMIT 1";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

function getAllSkills() {
    global $conn;
    $query = "SELECT * FROM skills ORDER BY display_order ASC";
    $result = $conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getActiveProjects() {
    global $conn;
    $query = "SELECT * FROM projects WHERE status = 'active' ORDER BY display_order ASC";
    $result = $conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getProjectById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function saveMessage($name, $email, $subject, $message) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    return $stmt->execute();
}

function uploadImage($file, $target_dir = "../assets/images/") {
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return false;
    }
    
    if($file["size"] > 5000000) {
        return false;
    }
    
    if(!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        return false;
    }
    
    if(move_uploaded_file($file["tmp_name"], $target_file)) {
        return basename($file["name"]);
    }
    
    return false;
}
?>