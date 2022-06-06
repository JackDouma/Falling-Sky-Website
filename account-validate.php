<?php
    try
    {
        // get inputs
        $name = $_POST['name'];
        $password = $_POST['password'];

        // connect sql
        require 'includes/db.php';

        // check to see if username matches any in database
        $sql = "SELECT * FROM accounts WHERE name = :name";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 20);
        $cmd->execute();
        $account = $cmd->fetch();

        // if username is not found
        if (!$account)
        {
            $db = null;
            header('location:login.php?invalid=true'); // send back invalid=true
        }
        // if username is found
        else
        {
            // if passwords match
            if (password_verify($password, $account['password']))
            {
                // start session
                session_start();
                $_SESSION['name'] = $name;
                $_SESSION['accountId'] = $account['accountId'];

                // send back to home
                header('location:index.php');  
            }
            // if passwords don't match
            else
            {
                $db = null;
                header('location:login.php?invalid=true'); // send back invalid=true
            }
        }
    }
    catch (Exception $error)
    {
        header('location:error.php');
    }
?>