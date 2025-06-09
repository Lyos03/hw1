<?php
require_once "db.php";
require_once "auth_functions.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nickname"]) && isset($_POST["community_id"])) {
    $nickname = mysqli_real_escape_string($conn, $_POST["nickname"]);
    $community_id = mysqli_real_escape_string($conn,$_POST["community_id"]);
    $nicknameExists = checkNicknameExists($nickname, $community_id);
    echo json_encode(['exists' => $nicknameExists]);
} else {
    echo json_encode(['error' => 'Invalid request']);
}

?>
