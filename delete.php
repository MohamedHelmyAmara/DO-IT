<?php 
    require_once 'connect.php';
    header('Access-Control-Allow-Methods: DELETE, OPTIONS');

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $data = json_decode(file_get_contents(('php://input')), true);
        $id = $data['id'];

        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo json_encode(array("message" => "Task deleted successfully"));
        } else {
            echo json_encode(array("message" => "Failed to delete task"));
        }
    }
    else {
        echo json_encode(array("message" => "Invalid request method"));
    }
?>