<?php 
    session_start();
    $type = $_POST['type'];
    $_SESSION["user_type"] = $type;
    
    header('Content-Type: application/json'); 
    echo json_encode(['status' => 'success', 'message' => $type]);

?>