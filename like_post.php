<?php
require_once "auth.php";
require_once "functions.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST" && $userid = checkAuth()) {
    $post_id = isset($_POST["post_id"]) ? $_POST["post_id"] : null;
    
    if ($post_id) {
        $liked = togglePostLike($userid, $post_id);
        $likes_count = getPostLikesCount($post_id);
        
        
        echo json_encode([
            "success" => true,
            "liked" => $liked,
            "likes_count" => $likes_count
        ]);
        exit;
    }
}

echo json_encode(["success" => false]);

?>