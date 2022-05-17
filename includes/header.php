<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Falling Sky | <?php echo $title; ?></title>

    <!-- bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- css -->
    <link type="text/css" rel="stylesheet" href="css/styles.css" />

    <!-- java script -->
    <script src="js/scripts.js" type="text/javascript" defer></script>
</head>

<!-- body start -->
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">

            <!-- logo -->
            <img src="./img/logo.png" alt="our logo">

            <!-- Redirect to main index -->
            <a class="navbar-brand" href="index.php">Home</a>


            <!-- left side of header -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav"> 
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
                        if(empty($_SESSION['captainName']) && if(empty($_SESSION['adminName'])))
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
                            echo 
                            '<li class="nav-item">
                                <a class="nav-link" href="#">' . $_SESSION['adminName'] . '</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>';
                        }
                        // logged in as captain
                        else if(!empty($_SESSION['captainName']))
                        {
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