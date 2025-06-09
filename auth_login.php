<?php
require_once "db.php";
require_once "auth_functions.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userEmail']) && isset($_POST["login_password"])) {
    $email = mysqli_real_escape_string($conn, $_POST['userEmail']);

    $password = mysqli_real_escape_string($conn, $_POST['login_password']);
    
    
    $user = authenticateUser($email, $password);
    
    if ($user) {
        echo json_encode([
            'success' => true,
            'user' => $user
        ]);
    } else {
        echo json_encode([
            'success'=> false,
            'error' => 'Invalid email or password'
        ]);
    }

} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>