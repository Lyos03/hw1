<?php
require_once "db.php";
require_once "auth.php";


header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST["nickname"]) || !isset($_POST["community_id"])) {
        echo json_encode(["success" => false, "error" => "Missing required fields"]);
        exit;
    }

    if (!$userid = checkAuth()) {
        echo json_encode(["success" => false, "error" => "Not authenticated"]);
        exit;
    }

    if (!preg_match('/^[a-zA-Z0-9_]{3,10}$/', $_POST["nickname"])) {
        echo json_encode(["success" => false, "error" => "Username must be 3-10 characters and can only contain letters, numbers, or underscores"]);
        exit;
    }

    $community_id = mysqli_real_escape_string($conn, $_POST["community_id"]);
    $nickname = mysqli_real_escape_string($conn, $_POST["nickname"]);

    $checkQuery = "SELECT id FROM community_members 
                  WHERE display_name = '$nickname' 
                  AND community_id = $community_id 
                  LIMIT 1";

    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo json_encode(["success" => false, "error" => "This nickname is already taken in this community"]);
        exit;
    }

    $insertQuery = "INSERT INTO community_members (user_id, community_id, display_name) 
                   VALUES ($userid, $community_id, '$nickname')";

    if (mysqli_query($conn, $insertQuery)) {
        $subscriptionQuery = "INSERT IGNORE INTO user_subscriptions (user_id, community_id) 
                             VALUES ($userid, $community_id)";

        if (mysqli_query($conn, $subscriptionQuery)) {
            echo json_encode(["success" => true]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Database error: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>