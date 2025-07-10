<?php
include 'db_config.php';

// Set content type to JSON
header('Content-Type: application/json');

// Query to get all contacts
$sql = "SELECT id, name, age, status, created_at FROM contacts ORDER BY created_at DESC";
$result = $conn->query($sql);

$contacts = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $contacts[] = array(
            'id' => $row['id'],
            'name' => htmlspecialchars($row['name']),
            'age' => $row['age'],
            'status' => $row['status'],
            'created_at' => date('Y-m-d H:i:s', strtotime($row['created_at']))
        );
    }
}

// Return JSON response
echo json_encode($contacts);

$conn->close();
?>