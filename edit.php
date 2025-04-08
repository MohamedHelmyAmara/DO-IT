<?php 
    require_once 'connect.php';
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    $data = json_decode(file_get_contents(('php://input')), true);
    $id = $data['id'];
    $title = $data['title'];
    $description = $data['description'];
    $status = $data['status'];

    $stmt = $conn->prepare("UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "Task updated successfully"));
    } else {    
        echo json_encode(array("message" => "Failed to update task"));
    }

?>