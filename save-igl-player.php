<?php
    try
    {
        // get header
        $title = 'Saving IGL Player...';
        require 'includes/header.php';

        // get form inputs
        $name = $_POST['name'];
        $bio = $_POST['bio'];
        $tier = $_POST['tier'];
        $ok = true;


        // make sure some inputs are not empty
        if (empty($name)) 
        {
            echo '<p class="alert alert-info">Name is required.</p>';
            $ok = false;
        }
        
        if (empty($tier)) 
        {
            echo '<p class="alert alert-info">Tier is required.</p>';
            $ok = false;
        }


        // if all pass
        if ($ok)
        {
            // connect sql
            require 'includes/db.php';

            // check for any existing player
            $sql = "SELECT * FROM  iglPlayers WHERE name = :name";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':name', $name, PDO::PARAM_STR, 20);
            $cmd->execute();
            $player = $cmd->fetch();
            // if dupe is found
            if ($player) 
            {
                echo '<p class="alert alert-info">Player already exists.</p>';
                $db = null;
            }
            // if no dupe is found
            else
            {
                // save new player
                $sql = "INSERT INTO iglPlayers (name, bio, tier) VALUES (:name, :bio, :tier)";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':name', $name, PDO::PARAM_STR, 20);
                $cmd->bindParam(':bio', $bio, PDO::PARAM_STR, 100);
                $cmd->bindParam(':tier', $tier, PDO::PARAM_INT);

                // bind Id param only when we have 1 
                if (!empty($iglPlayerId)) 
                {
                    $cmd->bindParam(':iglPlayerId', $iglPlayerId, PDO::PARAM_INT);
                }

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