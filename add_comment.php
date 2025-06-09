<?php
require_once "db.php";
require_once "auth.php";
require_once "functions.php";

if (!$userid = checkAuth()) {
    exit;
}

header("Content-Type: application/json");

if (isset($_POST["post_id"]) && isset($_POST["content"])) {
    $maxChar=25;

    if(empty($_POST["content"])){
        echo json_encode(["success" =>false,"error"=> "the comment is empty"]);
        exit;
    }

    if(strlen($_POST["content"]) > $maxChar) {
        echo json_encode(["success" =>false,"error"=> "the maximum consented number of characters is".' '. $maxChar]);
        exit;
    }

    $post_id = mysqli_real_escape_string($conn, $_POST["post_id"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);

    if (addComment($userid, $post_id, $content)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Failed to add comment"]);
    }
}
?>