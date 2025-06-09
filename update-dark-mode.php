<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $darkMode = isset($_POST['darkMode']) && $_POST['darkMode'] === 'true';
    setcookie('darkMode', $darkMode ? 'true' : 'false');
    echo 'OK';
    exit;
}
?>