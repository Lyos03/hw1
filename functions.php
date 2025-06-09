<?php
function getUserInfo($user_id)
{
    global $conn;
    $user_id = mysqli_real_escape_string($conn, $user_id);

    $query = "SELECT id, username, email FROM users WHERE id = '$user_id' LIMIT 1";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    return mysqli_fetch_assoc($result);
}

function getCommunityInfo($communityId)
{
    global $conn;

    $communityId = mysqli_real_escape_string($conn, $communityId);

    $query = "SELECT id, name, cover_image, logo, community_feed_link, community_media_link, is_artist, is_group, created_at 
              FROM communities 
              WHERE id='$communityId'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);

    return $row;
}

function getCommunityMembersCount($communityId)
{
    global $conn;

    $communityId = mysqli_real_escape_string($conn, $communityId);

    $query = "SELECT COUNT(*) as member_count 
              FROM community_members 
              WHERE community_id='$communityId'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);

    return $row['member_count'];
}

function getAllCommunities()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM communities");

    $allComunities = array();
    while ($row = mysqli_fetch_array($result)) {
        $allComunities[] = $row;
    }
    return $allComunities;
}

function getSubscribedCommunities($userId)
{
    global $conn;
    $userId = mysqli_real_escape_string($conn, $userId);

    $query = "SELECT c.* FROM communities c JOIN user_subscriptions us ON c.id = us.community_id WHERE us.user_id = '$userId'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $subbedCommunities = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $subbedCommunities[] = $row;
    }
    return $subbedCommunities;
}

function getNonSubscribedCommunities($userId)
{
    global $conn;
    $userId = mysqli_real_escape_string($conn, $userId);

    $query = "SELECT c.* FROM communities c WHERE c.id NOT IN (SELECT community_id FROM user_subscriptions WHERE user_id = '$userId')";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $nonSubbedCommunities = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $nonSubbedCommunities[] = $row;
    }
    return $nonSubbedCommunities;
}

function searchCommunityId($communityName)
{
    global $conn;

    $communityName = mysqli_real_escape_string($conn, $communityName);

    $query = "SELECT c.id FROM communities c WHERE c.name='$communityName'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);

    return $row["id"];
}

function getPosts($communityId)
{
    global $conn;

    $communityId = mysqli_real_escape_string($conn, $communityId);
    $query = "SELECT p.*, cm.profile_picture, cm.display_name 
                           FROM posts p
                           JOIN users u ON p.author_id = u.id
                           LEFT JOIN community_members cm ON (cm.user_id = u.id AND cm.community_id = p.community_id)
                           WHERE p.community_id = '$communityId'
                           ORDER BY p.created_at ASC";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $posts = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
    return $posts;
}

function checkSubscription($userId, $communityId)
{
    global $conn;

    $userId = mysqli_real_escape_string($conn, $userId);
    $communityId = mysqli_real_escape_string($conn, $communityId);

    $query = "SELECT COUNT(*) as count 
              FROM user_subscriptions 
              WHERE user_id = '$userId' AND community_id = '$communityId'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);

    return $row['count'] > 0;
}



function getCommunityMemberInfo($userId, $communityId)
{
    global $conn;

    $userId = mysqli_real_escape_string($conn, $userId);
    $communityId = mysqli_real_escape_string($conn, $communityId);

    $query = "SELECT cm.display_name, cm.profile_picture FROM community_members cm 
              WHERE cm.user_id='$userId' AND cm.community_id='$communityId'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);

    return $row;
}


function getUserPostsCount($userId, $communityId)
{
    global $conn;

    $userId = mysqli_real_escape_string($conn, $userId);
    $communityId = mysqli_real_escape_string($conn, $communityId);

    $query = "SELECT COUNT(*) as post_count FROM posts 
              WHERE author_id='$userId' AND community_id='$communityId'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);

    return $row["post_count"];
}

function hasUserLikedPost($user_id, $post_id)
{
    global $conn;

    $user_id = mysqli_real_escape_string($conn, $user_id);
    $post_id = mysqli_real_escape_string($conn, $post_id);

    $query = "SELECT id FROM post_likes WHERE user_id='$user_id' AND post_id='$post_id'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    return mysqli_num_rows($result) > 0;
}

function getPostLikesCount($post_id)
{
    global $conn;

    $post_id = mysqli_real_escape_string($conn, $post_id);

    $query = "SELECT COUNT(*) as count FROM post_likes WHERE post_id='$post_id'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);

    return $row["count"];
}

function togglePostLike($user_id, $post_id)
{
    global $conn;

    $user_id = mysqli_real_escape_string($conn, $user_id);
    $post_id = mysqli_real_escape_string($conn, $post_id);

    if (hasUserLikedPost($user_id, $post_id)) {
        $query = "DELETE FROM post_likes WHERE user_id='$user_id' AND post_id='$post_id'";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
        return false;
    } else {
        $query = "INSERT INTO post_likes (user_id, post_id) VALUES ('$user_id', '$post_id')";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
        return true;
    }
}

function getCommentsCount($post_id) {
    global $conn;

    $post_id = mysqli_real_escape_string($conn, $post_id);

    $query = "SELECT COUNT(*) as count FROM comments WHERE post_id='$post_id'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);

    return $row["count"];
}

function getComments($post_id) {
    global $conn;

    $post_id = mysqli_real_escape_string($conn, $post_id);

    $query = "SELECT c.*, cm.profile_picture, cm.display_name 
              FROM comments c
              JOIN community_members cm ON c.user_id = cm.user_id
              WHERE c.post_id = '$post_id'
              ORDER BY c.created_at DESC";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $comments = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }
    return $comments;
}

function addComment($user_id, $post_id, $content) {
    global $conn;

    $user_id = mysqli_real_escape_string($conn, $user_id);
    $post_id = mysqli_real_escape_string($conn, $post_id);
    $content = mysqli_real_escape_string($conn, $content);

    $query = "INSERT INTO comments (post_id, user_id, content) VALUES ('$post_id', '$user_id', '$content')";
    return mysqli_query($conn, $query) or die(mysqli_error($conn));
}

function isDarkMode(){
    $darkMode = isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'true';
    return $darkMode;
}

if (isset($_GET['action']) && $_GET['action'] === 'getDarkMode') {
    header('Content-Type: application/json');
    echo json_encode(['darkMode' => isDarkMode()]);
    exit;
}
?>