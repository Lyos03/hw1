<?php
require_once "db.php";
require_once "auth.php";
require_once "functions.php";

if (!$userid = checkAuth()) {
    exit;
}

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["community_id"]) && isset($_POST["postText"])) {
    $maxChar=50;
    if(empty($_POST["postText"])) {
        echo json_encode(["success" =>false,"error" => "the post is empty"]);
        exit;
    }

    if(strlen($_POST["postText"]) > $maxChar) {
        echo json_encode(["success"=>false,"error"=> "the maximum consented number of characters is".' '. $maxChar]);
        exit;
    }
    $userid = mysqli_real_escape_string($conn, $userid);
    $community_id = mysqli_real_escape_string($conn, $_POST["community_id"]);
    $postText = mysqli_real_escape_string($conn, $_POST["postText"]);

    $query = "INSERT INTO posts (community_id, author_id, content) VALUES ('$community_id', '$userid', '$postText')";

    if (mysqli_query($conn, $query) or die(mysqli_error($conn))) {
        $post_id = mysqli_insert_id($conn);

        $user_info = getUserInfo($userid);

        echo json_encode([
            "success" => true,
            "post_id" => $post_id,
            "user" => $user_info
        ]);
        exit;
    }
}
?>