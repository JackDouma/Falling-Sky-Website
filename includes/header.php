<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Syncopate:wght@700&display=swap');
        </style>

        <title>Falling Sky | <?php echo $title; ?></title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        
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
            <div class="container-fluid">
                <!-- logo 
                <img src="./img/logo.png" alt="our logo"> -->

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- left side of header -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav"> 
                        <li class="nav-item">
                            <img id="navimg" src="img\FSE1.png">
                            <a class="left-links" href="index.php"><b>HOME</b></a>
                            <a class="left-links" href="about-the-staff.php"><b>STAFF</b></a>
                            <a class="left-links" href="https://realgamerwear.net/teams/falling-sky-esports/"><b>MERCH</b></a>
                            <a class="left-links" href="contact.php"><b>CONTACT</b></a>
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
                </div>
            </div>
        </nav>