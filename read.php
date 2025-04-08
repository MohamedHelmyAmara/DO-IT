<?php   
    require_once 'connect.php';

    header('Access-Control-Allow-Methods: GET, OPTIONS');
    
    $stmt = $conn->prepare("SELECT * FROM tasks");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);

?>