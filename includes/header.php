<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="This is the official website for Falling Sky Esports">
        <meta name="robots" content="noindex, nofollow">
        <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@700&display=swap" rel="stylesheet">

        <title>Falling Sky | <?php echo $title; ?></title>
        <link rel="icon" href="img\star.png">

        <!-- css -->
        <link rel="stylesheet" href="styles.css">
        <!-- bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
        <!-- java script -->
        <script src="js/scripts.js" type="text/javascript" defer></script>
    </head>

    <!-- body start -->
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <ul class="navbar-nav"> 
                <li class="nav-item">
                    <img id="logo" src="img\logo.png">
                    <a class="left-links" href="index.php">Home</a>
                    <a class="left-links" href="rocket-league.php">Teams</a>
                    <a class="left-links" href="staff.php">Staff</a>
                    <?php
                        if (session_status() == PHP_SESSION_NONE)
                        {
                            session_start();
                        }
                        // logged in as admin
                        if($_SESSION['type'] == 1)
                        {
                            echo 
                            '<a class="left-links" href="settings.php">Settings</a>                                                                            
                            <a class="left-links" href="logout.php">Logout</a>';
                        }
                        // logged in as captain
                        else if($_SESSION['type'] == 2)
                        {
                            echo 
                            '<a class="left-links" href="logout.php">Logout</a>';
                        }
                        // not logged in as either captain or admin
                        else
                        {
                            echo 
                            '<a class="left-links" href="login.php">Login</a>';
                        }
                    ?>
                </li>                   
            </ul>               
        </nav>