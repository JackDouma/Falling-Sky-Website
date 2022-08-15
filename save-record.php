<?php
    try
    {
        // get header
        $title = 'Saving Record...';
        require 'includes/header.php';
        require 'includes/admin-auth.php';

        // get form inputs
        $iglTeamId = $_POST['iglTeamId'];
        $teamName = $_POST['teamName'];
        $seriesWins = $_POST['seriesWins'];
        $seriesLosses = $_POST['seriesLosses'];
        $placement = $_POST['placement'];
        $ok = true;


        // make sure some inputs are not empty
        if (empty($teamName)) 
        {
            echo '<p class="alert alert-info">Team Name is required.</p>';
            $ok = false;
        }
        
        if ($seriesWins < 0) 
        {
            echo '<p class="alert alert-info">Wins must be 0 or greater.</p>';
            $ok = false;
        }

        if ($seriesLosses < 0) 
        {
            echo '<p class="alert alert-info">Losses must be 0 or greater.</p>';
            $ok = false;
        }


        // if all pass
        if ($ok)
        {
            if (!empty($iglTeamId))
            {
                // connect sql
                require 'includes/db.php';

                // check for id
                $sql = "SELECT * FROM iglTeams WHERE iglTeamId = :iglTeamId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':iglTeamId', $iglTeamId, PDO::PARAM_INT);
                $cmd->execute();
                $team = $cmd->fetch();
                
                // if team found
                if ($team)
                {
                    // sql update command
                    $sql = "UPDATE iglTeams SET teamName = :teamName, seriesWins = :seriesWins, seriesLosses = :seriesLosses, placement = :placement WHERE iglTeamId = :iglTeamId";
                    $cmd = $db->prepare($sql);
                    $cmd->bindParam(':teamName', $teamName, PDO::PARAM_STR, 25);
                    $cmd->bindParam(':seriesWins', $seriesWins, PDO::PARAM_INT);
                    $cmd->bindParam(':seriesLosses', $seriesLosses, PDO::PARAM_INT);
                    $cmd->bindParam(':placement', $placement, PDO::PARAM_STR, 10);

                    if (!empty($iglTeamId)) 
                    {
                        $cmd->bindParam(':iglTeamId', $iglTeamId, PDO::PARAM_INT);
                    }

                    $cmd->execute();

                    $db = null;

                    echo '<div class="alert alert-info">Team Saved.  
                        <a href="igl-team-details.php?iglTeamId=' . $iglTeamId . '">Return to Team Page</a>
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
    }
    catch (Exception $error)
    {
        header('location:error.php');
    }
?>
</body>
<?php
    require 'includes/footer.php';
?>
</html>