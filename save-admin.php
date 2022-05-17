<?php
    try
    {
        // get header
        $title = 'Saving Admin...';
        require 'includes/header.php';

        // get form inputs
        $adminName = $_POST['adminName'];
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
        if (empty($adminName)) 
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
            $sql = "SELECT * FROM admins WHERE adminName = :adminName";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':adminName', $adminName, PDO::PARAM_STR, 20);
            $cmd->execute();
            $admin = $cmd->fetch();
            // if dupe is found
            if ($admin) 
            {
                echo '<p class="alert alert-info">Username already exists.</p>';
                $db = null;
            }
            // if no dupe is found
            else
            {
                // encrypt password
                $password = password_hash($password, PASSWORD_DEFAULT);

                // save new admin
                $sql = "INSERT INTO admins (adminName, password) VALUES (:adminName, :password)";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':adminName', $adminName, PDO::PARAM_STR, 20);
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