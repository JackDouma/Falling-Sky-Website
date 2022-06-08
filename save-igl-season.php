<?php
    try
    {
        // get header
        $title = 'Saving IGL Player...';
        require 'includes/header.php';
        require 'includes/admin-auth.php';

        // get form inputs
        $seasonName = $_POST['seasonName'];
        $ok = true;


        // make sure some inputs are not empty
        if (empty($seasonName)) 
        {
            echo '<p class="alert alert-info">Name is required.</p>';
            $ok = false;
        }


        // if all pass
        if ($ok)
        {
            // connect sql
            require 'includes/db.php';
            
            // check for any existing seasons
            $sql = "SELECT * FROM seasons WHERE seasonName = :seasonName";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':seasonName', $seasonName, PDO::PARAM_STR, 20);
            $cmd->execute();
            $season = $cmd->fetch();

            // if dupe is found
            if ($season) 
            {
                echo '<p class="alert alert-info">Season already exists.</p>';
                $db = null;
            }
            // if no dupe is found
            else
            {
                // save new player
                $sql = "INSERT INTO seasons (seasonName) VALUES (:seasonName)";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':seasonName', $seasonName, PDO::PARAM_STR, 20);
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