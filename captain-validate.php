<?php
    try
    {
        // get inputs
        $captainName = $_POST['captainName'];
        $password = $_POST['password'];

        // connect sql
        require 'includes/db.php';

        // check to see if username matches any in database
        $sql = "SELECT * FROM captains WHERE captainName = :captainName";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':captainName', $captainName, PDO::PARAM_STR, 20);
        $cmd->execute();
        $captain = $cmd->fetch();

        // if username is not found
        if (!$captain)
        {
            $db = null;
            header('location:captain-login.php?invalid=true'); // send back invalid=true
        }
        // if username is found
        else
        {
            // if passwords match
            if (password_verify($password, $captain['password']))
            {
                // start session
                session_start();
                $_SESSION['captainName'] = $captainName;
                $_SESSION['captainId'] = $captain['captainId'];

                // send back to home
                header('location:index.php');  
            }
            // if passwords don't match
            else
            {
                $db = null;
                header('location:captain-login.php?invalid=true'); // send back invalid=true
            }
        }
    }
    catch (Exception $error)
    {
        header('location:error.php');
    }
?>