<?php
require_once "db.php";
require_once "auth_functions.php";
require_once "auth.php";


if (checkAuth()) {
    header("Location: index.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = '';
    if (!empty($_POST['login_password']) && !empty($_POST['userEmail'])) {
        $email = mysqli_real_escape_string($conn, $_POST['userEmail']);
        $password = mysqli_real_escape_string($conn, $_POST['login_password']);

        $user = authenticateUser($email, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];

            header("Location: index.php");
            mysqli_close($conn);
            exit;
        }

    } elseif (isset($_POST['signup_password']) && isset($_POST['signup_password_confirm']) && isset($_POST['signup_email']) && isset($_POST['signup_username'])) {

        $email = mysqli_real_escape_string($conn, $_POST['signup_email']);
        $password = mysqli_real_escape_string($conn, $_POST['signup_password']);
        $passwordConfirm = mysqli_real_escape_string($conn, $_POST['signup_password_confirm']);
        $username = mysqli_real_escape_string($conn, $_POST['signup_username']);

        if (strlen($password) < 6 || strlen($passwordConfirm) < 6) {
            $error = "Password need to have at least 6 characters";
        } elseif ($password !== $passwordConfirm) {
            $error = "Passwords don't match";
        } elseif (!preg_match('/^[a-zA-Z0-9_]{3,10}$/', $username)) {
            $error = "Username must be 3-10 characters and can only contain letters, numbers, or underscores";
        } elseif (checkUsernameExists($username)) {
            $error = "This username is already registered.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Please enter a valid email";
        } elseif (checkEmailExists($email)) {
            $error = "This email is already registered.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users (email, username, password_hash) VALUES ('$email','$username', '$passwordHash')";

            if (mysqli_query($conn, $query)) {
                $_SESSION['user_id'] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: index.php");
                exit;
            } {
                $error = "Database connection error";
            }
        }

    } elseif (isset($_POST['userEmail'])) {
        $email = mysqli_real_escape_string($conn, $_POST['userEmail']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['email_to_verify'] = $email;
        } else {
            $error = "Please enter a valid email";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Weverse - Sign In / Sign Up</title>
    <link rel="stylesheet" href="src_used/signin/signin.css">
    <link rel="stylesheet" href="src_used/footer/footer.css">
    <link rel="stylesheet" href="src_used/global/styles.css">

    <script src="src_used/global/GeneralFunctions.js" defer></script>
    <script src="src_used/global/dark-mode_controller.js" defer></script>
    <script src="src_used/signin/signin.js" defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div id="Signin_container">
        <div id="Signin_area">
            <h1 id="Signin_title_container">Weverse Account</h1>
            <form method="POST" id="authForm">
                <div id="Form_content_container">

                </div>
            </form>
            <?php if (isset($error)): ?>
                <strong class="error"><?php echo $error; ?></strong>
            <?php endif; ?>
        </div>
    </div>

    <div class="Footer">
        <footer class="Footer_inner_area">
            <p class="Footer_text_container">
                <span class="Footer_highlight">Company Name</span> Bora Company Inc. <span
                    class="Footer_highlight">CEO</span> Kim Nam Joon <br>
                <span class="Footer_highlight">Call Center</span> xxxx-xxxx <span class="Footer_highlight">FAX</span>
                +82 x-xxxx-xxxx <br>
                <span class="Footer_highlight">Address</span><br> The Magic Shop<br>
                <span class="Footer_highlight">Business Registration Number</span> 061313 <br><br>
                <span class="Footer_highlight">Hosted by</span> Amazon Web Services, Inc., Naver Cloud <br>
            </p>
        </footer>
    </div>
</body>

</html>