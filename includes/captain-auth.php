<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

// an admin can do what a mod can do
// check session for admin. If exists, user is logged in
if(empty($_SESSION['captainUser']) && if(empty($_SESSION['adminUser'])))
{
    
    header('location:login.php');
    exit();
}