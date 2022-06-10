<?php
    $title = 'Delete IGL Team';
    require 'includes/header.php';
    require 'includes/admin-auth.php';

    try
    {
        // validate primary key
        if (isset($_GET['iglTeamId']))
        {
            if (is_numeric($_GET['iglTeamId']))
            {
                // connect sql
                require 'includes/db.php';

                // sql delete command
                $sql = "DELETE FROM iglTeams WHERE iglTeamId = :iglTeamId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':iglTeamId', $_GET['iglTeamId'], PDO::PARAM_INT);
                $cmd->execute();
               
                $db = null;

                // show result
                echo '<div class="alert alert-info">Team deleted.  
                        <a href="igl-teams.php">Return to Team List</a>
                    </div>';
                }
            else
            {
                echo '<div class="alert alert-warning">Team Missing</div>';
            }
        }
        else
        {
            echo '<div class="alert alert-warning">Team Missing</div>';
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