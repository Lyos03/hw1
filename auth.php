<?php
require_once "db.php";
session_start();

function checkAuth()
{
    if (isset($_SESSION["user_id"])) {
        return $_SESSION["user_id"];
    }else return 0;
}
