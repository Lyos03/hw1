<?php
require_once "db.php";
require_once "auth_functions.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userEmail'])) {
    $email = mysqli_real_escape_string($conn,$_POST['userEmail']);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailExists = checkEmailExists($email);
        echo json_encode(['exists' => $emailExists]);
    } else {
        echo json_encode(['error' => 'Invalid email format']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>