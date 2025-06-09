<?php
require_once "db.php";
require_once "auth_functions.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $usernameExists = checkUsernameExists($username);
    echo json_encode(['exists' => $usernameExists]);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>