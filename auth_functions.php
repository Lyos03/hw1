<?php
function checkEmailExists($email) {
    global $conn;
    $email = mysqli_real_escape_string($conn, $email);

    $query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    return mysqli_num_rows($result) > 0;
}

function checkUsernameExists($username) {
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);

    $query = "SELECT username FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    return mysqli_num_rows($result) > 0;
}

function checkNicknameExists($nickname, $community_id) {
    global $conn;
    
    $nickname = mysqli_real_escape_string($conn, $nickname);
    $community_id = mysqli_real_escape_string($conn, $community_id);


    $query = "SELECT id FROM community_members 
              WHERE display_name = '$nickname' 
              AND community_id = $community_id 
              LIMIT 1";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    return mysqli_num_rows($result) > 0;
}

function authenticateUser($email, $password) {
    global $conn;
    $email = mysqli_real_escape_string($conn, $email);
    
    $query = "SELECT id, email, password_hash, username FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        return false;
    }
    
    if (password_verify($password, $user['password_hash'])) {
       
        return [
            'id' => $user['id'],
            'email' => $user['email'],
            'username' => $user['username']
        ];
    }
    
    return false;
}

?>