<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

// check session for admin. If exists, user is logged in
if($_SESSION['accountId'] != 1)
{
    header('location:login.php');
    exit();
}