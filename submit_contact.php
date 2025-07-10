<?php
include 'db_config.php';

// Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $age = intval($_POST['age']);
    
    // Validate input
    if (empty($name) || $age <= 0 || $age > 150) {
        header('Location: index.html?error=invalid_data');
        exit();
    }
    
    // Insert into database
    $sql = "INSERT INTO contacts (name, age, status, created_at) VALUES (?, ?, 0, NOW())";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("si", $name, $age);
        
        if ($stmt->execute()) {
            header('Location: index.html?success=1');
        } else {
            header('Location: index.html?error=database_error');
        }
        
        $stmt->close();
    } else {
        header('Location: index.html?error=prepare_failed');
    }
} else {
    // Redirect if not POST request
    header('Location: index.html');
}

$conn->close();
?>