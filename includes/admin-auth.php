<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

// check session for admin. If exists, user is logged in
if(empty($_SESSION['adminUser']))
{
    header('location:login.php');
    exit();
}