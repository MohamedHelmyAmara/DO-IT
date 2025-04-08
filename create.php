<?php 
    require_once 'connect.php';
    header('Access-Control-Allow-Methods: POST, OPTIONS');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents(('php://input')), true);
        $title = $data['title'];
        $description = $data['description'];
        $status = $data['status'];

        if (empty($title) || empty($description) || empty($status)) {
            echo json_encode(array("message" => "All fields are required"));
            exit;
        }
        
        $stmt = $conn->prepare("INSERT INTO tasks (title, description, status) VALUES (:title, :description, :status)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            echo json_encode(array("message" => "Task created successfully"));
        } else {
            echo json_encode(array("message" => "Failed to create task"));
        }
    }

?>