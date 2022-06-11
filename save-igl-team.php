<?php
    try
    {
        // get header
        $title = 'Saving IGL Team...';
        require 'includes/header.php';

        // get form inputs
        $iglTeamId = $_POST['iglTeamId'];
        $teamName = $_POST['teamName'];
        $mode = $_POST['mode'];
        $tier = $_POST['tier'];
        $seasonId = $_POST['seasonId'];
        $captain = $_POST['captain'];
        $player1 = $_POST['player1'];
        $player2 = $_POST['player2'];
        $player3 = $_POST['player3'];
        $player4 = $_POST['player4'];
        $ok = true;


        // make sure some inputs are not empty
        if (empty($teamName)) 
        {
            echo '<p class="alert alert-info">Team Name is required.</p>';
            $ok = false;
        }
        
        if (empty($mode)) 
        {
            echo '<p class="alert alert-info">Gamemode is required.</p>';
            $ok = false;
        }

        if (empty($tier)) 
        {
            echo '<p class="alert alert-info">Tier is required.</p>';
            $ok = false;
        }

        if (empty($seasonId)) 
        {
            echo '<p class="alert alert-info">Season is required.</p>';
            $ok = false;
        }

        if (empty($captain)) 
        {
            echo '<p class="alert alert-info">Captain is required.</p>';
            $ok = false;
        }

        // very fun process of checking for dupes
        if(!empty($captain) && $captain == $player1 || $captain == $player2 || $captain == $player3 || $captain == $player4)
        {
            echo '<p class="alert alert-info">You cannot select the same player more than once.</p>';
            $ok = false;
        }

        if (!empty($player1) && $player1 == $player2 || $player1 == $player3 || $player1 == $player4)
        {
            echo '<p class="alert alert-info">You cannot select the same player more than once.</p>';
            $ok = false;
        }

        if (!empty($player2) && $player2 == $player3 || $player2 == $player4)
        {
            echo '<p class="alert alert-info">You cannot select the same player more than once.</p>';
            $ok = false;
        }

        if (!empty($player3) && $player3 == $player4)
        {
            echo '<p class="alert alert-info">You cannot select the same player more than once.</p>';
            $ok = false;
        }


        // if all pass
        if ($ok)
        {
            // connect sql
            require 'includes/db.php';

            //// new team ////
            if (empty($iglTeamId))
            {
                // check for any existing teams. There can be multipe teams with the same name in different seasons, or modes.
                $sql = "SELECT * FROM iglTeams WHERE teamName = :teamName AND mode = :mode AND seasonId = :seasonId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':teamName', $teamName, PDO::PARAM_STR, 25);
                $cmd->bindParam(':mode', $mode, PDO::PARAM_STR, 10);
                $cmd->bindParam(':seasonId', $seasonId, PDO::PARAM_INT);
                $cmd->execute();
                $team = $cmd->fetch();
                // if dupe is found
                if ($team) 
                {
                    echo '<p class="alert alert-info">Team already exists.</p>';
                    $db = null;
                }
                // if no dupe is found
                else
                {
                    // save new team
                    $sql = "INSERT INTO iglTeams (teamName, mode, tier, seasonId, captain, player1, player2, player3, player4) VALUES (:teamName, :mode, :tier, :seasonId, :captain, :player1, :player2, :player3, :player4)";
                    $cmd = $db->prepare($sql);
                    $cmd->bindParam(':teamName', $teamName, PDO::PARAM_STR, 25);
                    $cmd->bindParam(':mode', $mode, PDO::PARAM_STR, 10);
                    $cmd->bindParam(':tier', $tier, PDO::PARAM_INT);
                    $cmd->bindParam(':seasonId', $seasonId, PDO::PARAM_INT);
                    $cmd->bindParam(':captain', $captain, PDO::PARAM_STR, 20);
                    $cmd->bindParam(':player1', $player1, PDO::PARAM_STR, 20);
                    $cmd->bindParam(':player2', $player2, PDO::PARAM_STR, 20);
                    $cmd->bindParam(':player3', $player3, PDO::PARAM_STR, 20);
                    $cmd->bindParam(':player4', $player4, PDO::PARAM_STR, 20);

                    $cmd->execute();

                    // disconnect from sql
                    $db = null;

                    echo '<div class="alert alert-info">Team Created.  
                        <a href="igl-teams.php">To Team List</a>
                    </div>';
                }
            }
            //// edit team ////
            else
            {
                // check for id
                $sql = "SELECT * FROM iglTeams WHERE iglTeamId = :iglTeamId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':iglTeamId', $iglTeamId, PDO::PARAM_INT);
                $cmd->execute();
                $team = $cmd->fetch();
                
                // if team found
                if($team)
                {
                    // sql update command
                    $sql = "UPDATE iglTeams SET teamName = :teamName, mode = :mode, tier = :tier, seasonId = :seasonId, captain = :captain, player1 = :player1, player2 = :player2, player3 = :player3, player4 = :player4 WHERE iglTeamId = :iglTeamId";
                    $cmd = $db->prepare($sql);
                    $cmd->bindParam(':teamName', $teamName, PDO::PARAM_STR, 20);
                    $cmd->bindParam(':mode', $mode, PDO::PARAM_STR, 10);
                    $cmd->bindParam(':tier', $tier, PDO::PARAM_INT);
                    $cmd->bindParam(':seasonId', $seasonId, PDO::PARAM_INT);
                    $cmd->bindParam(':captain', $captain, PDO::PARAM_STR, 20);
                    $cmd->bindParam(':player1', $player1, PDO::PARAM_STR, 20);
                    $cmd->bindParam(':player2', $player2, PDO::PARAM_STR, 20);
                    $cmd->bindParam(':player3', $player3, PDO::PARAM_STR, 20);
                    $cmd->bindParam(':player4', $player4, PDO::PARAM_STR, 20);
                    

                    if (!empty($iglTeamId)) 
                    {
                        $cmd->bindParam(':iglTeamId', $iglTeamId, PDO::PARAM_INT);
                    }

                    $cmd->execute();

                    $db = null;

                    echo '<div class="alert alert-info">Team Saved.  
                        <a href="igl-teams.php">Return to Player List</a>
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