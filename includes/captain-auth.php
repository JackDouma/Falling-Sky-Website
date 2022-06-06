<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

// check session for admin or captain. If exists, user is logged in
if($_SESSION['accountId'] != 1 || $_SESSION['accountId'] != 2)
{
    header('location:login.php');
    exit();
}