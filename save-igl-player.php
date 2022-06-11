<?php
    try
    {
        // get header
        $title = 'Saving IGL Player...';
        require 'includes/header.php';
        require 'includes/admin-auth.php';

        // get form inputs
        $iglPlayerId = $_POST['iglPlayerId'];
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

            //// new player ////
            if (empty($iglPlayerId))
            {
                // check for any existing player
                $sql = "SELECT * FROM iglPlayers WHERE name = :name";
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
                    $cmd->execute();

                    // disconnect from sql
                    $db = null;

                    echo '<div class="alert alert-info">Player Created.  
                        <a href="igl-players.php">To Player List</a>
                    </div>';
                }
            }
            //// edit player ////
            else
            {
                // check for id
                $sql = "SELECT * FROM iglPlayers WHERE iglPlayerId = :iglPlayerId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':iglPlayerId', $iglPlayerId, PDO::PARAM_INT);
                $cmd->execute();
                $player = $cmd->fetch();
                
                // if player found
                if($player)
                {
                    // sql update command
                    $sql = "UPDATE iglPlayers SET name = :name, bio = :bio, tier = :tier WHERE iglPlayerId = :iglPlayerId";
                    $cmd = $db->prepare($sql);
                    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 20);
                    $cmd->bindParam(':bio', $bio, PDO::PARAM_STR, 100);
                    $cmd->bindParam(':tier', $tier, PDO::PARAM_INT);

                    if (!empty($iglPlayerId)) 
                    {
                        $cmd->bindParam(':iglPlayerId', $iglPlayerId, PDO::PARAM_INT);
                    }

                    $cmd->execute();

                    $db = null;

                    echo '<div class="alert alert-info">Player Saved.  
                        <a href="igl-players.php">Return to Player List</a>
                    </div>';
                }
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