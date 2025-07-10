<?php
include 'db_config.php';

// Set content type to JSON
header('Content-Type: application/json');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get JSON input
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    // Validate input
    if (isset($data['id']) && isset($data['status'])) {
        $id = intval($data['id']);
        $status = intval($data['status']);
        
        // Ensure status is either 0 or 1
        if ($status !== 0 && $status !== 1) {
            echo json_encode(array('success' => false, 'message' => 'Invalid status value'));
            exit();
        }
        
        // Update status in database
        $sql = "UPDATE contacts SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("ii", $status, $id);
            
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo json_encode(array('success' => true, 'message' => 'Status updated successfully'));
                } else {
                    echo json_encode(array('success' => false, 'message' => 'No record found with that ID'));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'Failed to update status'));
            }
            
            $stmt->close();
        } else {
            echo json_encode(array('success' => false, 'message' => 'Database prepare failed'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Invalid input data'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}

$conn->close();
?>