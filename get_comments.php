<?php
require_once "db.php";
require_once "auth.php";
require_once "functions.php";

header("Content-Type: application/json");

if (isset($_GET["post_id"])) {
    $post_id = mysqli_real_escape_string($conn, $_GET["post_id"]);
    $comments = getComments($post_id);
    
    echo json_encode($comments);
} else {
    echo json_encode(array("error" => "Missing post_id parameter"));
}
?>