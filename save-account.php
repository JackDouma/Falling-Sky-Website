<?php
    try
    {
        // get header
        $title = 'Saving Account...';
        require 'includes/header.php';
        require 'includes/admin-auth.php';

        // get form inputs
        $name = $_POST['name'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        $type = $_POST['type'];
        $ok = true;

        // check if passwords match
        if ($password != $confirm) 
        {
            echo '<p class="alert alert-info">Passwords do not match.</p>';
            $ok = false;
        }

        // make sure inputs are not empty
        if (empty($name)) 
        {
            echo '<p class="alert alert-info">Username is required.</p>';
            $ok = false;
        }
        
        if (empty($password)) 
        {
            echo '<p class="alert alert-info">Password is required.</p>';
            $ok = false;
        }

        if (empty($type)) 
        {
            echo '<p class="alert alert-info">Type is required.</p>';
            $ok = false;
        }


        // if all pass
        if ($ok)
        {
            // connect sql
            require 'includes/db.php';

            // check for any existing usernames
            $sql = "SELECT * FROM accounts WHERE name = :name";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':name', $name, PDO::PARAM_STR, 20);
            $cmd->execute();
            $account = $cmd->fetch();
            // if dupe is found
            if ($account) 
            {
                echo '<p class="alert alert-info">Username already exists.</p>';
                $db = null;
            }
            // if no dupe is found
            else
            {
                // encrypt password
                $password = password_hash($password, PASSWORD_DEFAULT);

                // save new account
                $sql = "INSERT INTO accounts (type, name, password) VALUES (:type, :name, :password)";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':type', $type, PDO::PARAM_INT);
                $cmd->bindParam(':name', $name, PDO::PARAM_STR, 20);
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