<?php
    $title = 'Delete IGL Player';
    require 'includes/header.php';
    require 'includes/admin-auth.php';

    try
    {
        // validate primary key
        if (isset($_GET['iglPlayerId']))
        {
            if (is_numeric($_GET['iglPlayerId']))
            {
                // connect sql
                require 'includes/db.php';

                // sql delete command
                $sql = "DELETE FROM iglPlayers WHERE iglPlayerId = :iglPlayerId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':iglPlayerId', $_GET['iglPlayerId'], PDO::PARAM_INT);
                $cmd->execute();
               
                $db = null;

                // show result
                echo '<div class="alert alert-info">Player deleted.  
                        <a href="igl-players.php">Return to Player List</a>
                    </div>';
                }
            else
            {
                echo '<div class="alert alert-warning">Player Missing</div>';
            }
        }
        else
        {
            echo '<div class="alert alert-warning">Player Missing</div>';
        }
    }
    // if site is unable to load
    catch (Exception $error)
    {
        header('location:error.php');
    }
?>
</body>
</html>