<?php
    try
    {
        // get header
        $title = 'Saving Captain...';
        require 'includes/header.php';

        // get form inputs
        $captainName = $_POST['captainName'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        $ok = true;

        // check if passwords match
        if ($password != $confirm) 
        {
            echo '<p class="alert alert-info">Passwords do not match.</p>';
            $ok = false;
        }

        // make sure inputs are not empty
        if (empty($captainName)) 
        {
            echo '<p class="alert alert-info">Username is required.</p>';
            $ok = false;
        }
        
        if (empty($password)) 
        {
            echo '<p class="alert alert-info">Password is required.</p>';
            $ok = false;
        }


        // if all 3 checks passed
        if ($ok)
        {
            // connect sql
            require 'includes/db.php';

            // check for any existing usernames
            $sql = "SELECT * FROM captains WHERE captainName = :captainName";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':captainName', $captainName, PDO::PARAM_STR, 20);
            $cmd->execute();
            $captain = $cmd->fetch();
            // if dupe is found
            if ($captain) 
            {
                echo '<p class="alert alert-info">Username already exists.</p>';
                $db = null;
            }
            // if no dupe is found
            else
            {
                // encrypt password
                $password = password_hash($password, PASSWORD_DEFAULT);

                // save new captain
                $sql = "INSERT INTO captains (captainName, password) VALUES (:captainName, :password)";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':captainName', $captainName, PDO::PARAM_STR, 20);
                $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
                $cmd->execute();

                // disconnect from sql
                $db = null;

                // redirect to home page
                header('location:index.php');
            }
        }
    }
    catch (Exception $error)
    {
        header('location:error.php');
    }
?>
</body>
</html>