<?php
    try
    {
        // get inputs
        $adminName = $_POST['adminName'];
        $password = $_POST['password'];

        // connect sql
        require 'includes/db.php';

        // check to see if username matches any in database
        $sql = "SELECT * FROM admins WHERE adminName = :adminName";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':adminName', $adminName, PDO::PARAM_STR, 20);
        $cmd->execute();
        $admin = $cmd->fetch();

        // if username is not found
        if (!$admin)
        {
            $db = null;
            header('location:admin-login.php?invalid=true'); // send back invalid=true
        }
        // if username is found
        else
        {
            // if passwords match
            if (password_verify($password, $admin['password']))
            {
                // start session
                session_start();
                $_SESSION['adminName'] = $adminName;
                $_SESSION['adminId'] = $admin['adminId'];

                // send back to home
                header('location:index.php');  
            }
            // if passwords don't match
            else
            {
                $db = null;
                header('location:admin-login.php?invalid=true'); // send back invalid=true
            }
        }
    }
    catch (Exception $error)
    {
        header('location:error.php');
    }
?>