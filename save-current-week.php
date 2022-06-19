<?php
    try
    {
        // get header
        $title = 'Saving IGL Player...';
        require 'includes/header.php';
        require 'includes/admin-auth.php';

        // get form inputs
        $weekId = $_POST['weekId'];
        $seasonId = $_POST['seasonId'];
        $week = $_POST['week'];
        $ok = true;


        // make sure some inputs are not empty
        if (empty($seasonId)) 
        {
            echo '<p class="alert alert-info">Season is required.</p>';
            $ok = false;
        }
        
        if (empty($week)) 
        {
            echo '<p class="alert alert-info">Week is required.</p>';
            $ok = false;
        }


        // if all pass
        if ($ok)
        {
            //// new player ////
            if (!empty($weekId))
            {
                // connect sql
                require 'includes/db.php';

                // check for id
                $sql = "SELECT * FROM currentWeek WHERE weekId = :weekId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':weekId', $weekId, PDO::PARAM_INT);
                $cmd->execute();
                $player = $cmd->fetch();
                
                // if player found
                if($player)
                {
                    // sql update command
                    $sql = "UPDATE currentWeek SET seasonId = :seasonId, week = :week WHERE weekId = :weekId";
                    $cmd = $db->prepare($sql);
                    $cmd->bindParam(':seasonId', $seasonId, PDO::PARAM_INT);
                    $cmd->bindParam(':week', $week, PDO::PARAM_INT);

                    if (!empty($weekId)) 
                    {
                        $cmd->bindParam(':weekId', $weekId, PDO::PARAM_INT);
                    }

                    $cmd->execute();

                    $db = null;

                    echo '<div class="alert alert-info">Current Week Saved.  
                        <a href="index.php">Return to Home</a>
                    </div>';
                }
                //// edit player ////
                else
                {
                    echo '<div class="alert alert-warning">Week ID Missing</div>';                
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