<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="This is the official website for Falling Sky Esports">
        <meta name="robots" content="noindex, nofollow">
        <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@700&display=swap" rel="stylesheet">

        <title>Falling Sky | <?php echo $title; ?></title>
    
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
                    <a class="left-links" href="about-the-staff.php">About the Staff</a>
                    <a class="left-links" href="join-the-staff.php">Join the Staff</a>
                    <a class="left-links" href="https://realgamerwear.net/teams/falling-sky-esports/" target="_blank">Merch</a>
                </li>
                       
                <!-- This php code only adds the registered admins to the header if user if logged in-->
                <?php
                    if (session_status() == PHP_SESSION_NONE)
                    {
                        session_start();
                    }
                ?>
            </ul>

            <!-- right side of header -->
            <ul class="navbar-nav ms-auto">
                <!-- This php code will allow the user to login as either admin or captain-->
                <!-- If the user is already logged in as admin, it will display logging out, and name of the username -->
                <?php
                    // not logged in as either captain or admin
                    if(empty($_SESSION['captainName']) &&(empty($_SESSION['adminName'])))
                    {
                        echo 
                        '<li class="nav-item">
                            <a class="nav-link" href="admin-login.php">Admin Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="captain-login.php">Captain Login</a>
                        </li>';
                    }
                    // logged in as admin
                    else if(!empty($_SESSION['adminName']))
                    {
                        // in walter white voice "say my name", create player, team, admin, captain, logout. This will be put into seperate drop downs at some point
                        echo 
                        '<li class="nav-item">
                            <a class="nav-link" href="#">' . $_SESSION['adminName'] . '</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-igl-player.php">Create Player</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-igl-team.php">Create Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-admin.php">Create Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-captain.php">Create Captain</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>';
                    }
                    // logged in as captain
                    else if(!empty($_SESSION['captainName']))
                    {
                        // in walter white voice "say my name" 2) logout
                        echo 
                        '<li class="nav-item">
                            <a class="nav-link" href="#">' . $_SESSION['captainName'] . '</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>';
                    }
                ?>
            </ul>
                
        </nav>