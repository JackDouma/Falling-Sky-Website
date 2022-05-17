<?php
    session_start();

    // DESTROY session
    session_destroy();

    // redirect to home
    header('location:index.php');
?>