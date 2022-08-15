<?php
    try
    {
        
        // get header
        $title = 'Saving IGL Game...';
        require 'includes/header.php';
        require 'includes/captain-auth.php';

        // get form inputs
        $scheduleId = $_POST['scheduleId'];
        $iglTeamId = $_POST['iglTeamId'];
        $opponent = $_POST['opponent'];
        $week = $_POST['week'];
        $stream = $_POST['stream'];
        $gameWins = $_POST['gameWins'];
        $gameLosses = $_POST['gameLosses'];
        $ok = true;


        // make sure some inputs are not empty
        if (empty($iglTeamId)) 
        {
            echo '<p class="alert alert-info">Team is required.</p>';
            $ok = false;
        }
        
        if (empty($opponent)) 
        {
            echo '<p class="alert alert-info">Opponent is required.</p>';
            $ok = false;
        }

        if (empty($week)) 
        {
            echo '<p class="alert alert-info">Week is required.</p>';
            $ok = false;
        }

        if ($gameWins > 3 && $week < 8) 
        {
            echo '<p class="alert alert-info">Wins cannot be greater than 3 in weeks 1-8.</p>';
            $ok = false;
        }

        if ($gameLosses > 3 && $week < 8) 
        {
            echo '<p class="alert alert-info">Losses cannot be greater than 3 in weeks 1-8.</p>';
            $ok = false;
        }

        if ($gameWins > 4 && $week > 7) 
        {
            echo '<p class="alert alert-info">Wins cannot be greater than 4 in week 9 and 10.</p>';
            $ok = false;
        }

        if ($gameLosses > 4 && $week > 7) 
        {
            echo '<p class="alert alert-info">Losses cannot be greater than 4 in week 9 and 10.</p>';
            $ok = false;
        }

        if ($gameWins == $gameLosses && $gameWins > 0) 
        {
            echo '<p class="alert alert-info">Wins cannot be equal to losses.</p>';
            $ok = false;
        }

        // if all pass
        if ($ok)
        {
            // connect sql
            require 'includes/db.php';

            //// new team ////
            if (empty($scheduleId))
            {
                // check for any existing teams. There can be multipe teams with the same name in different seasons, or modes.
                $sql = "SELECT * FROM iglSchedule WHERE iglTeamId = :iglTeamId AND week = :week AND opponent = :opponent";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':iglTeamId', $iglTeamId, PDO::PARAM_INT);
                $cmd->bindParam(':week', $week, PDO::PARAM_INT);
                $cmd->bindParam(':opponent', $opponent, PDO::PARAM_STR, 30);
                $cmd->execute();
                $game = $cmd->fetch();
                // if dupe is found
                if ($game) 
                {
                    echo '<p class="alert alert-info">Game already exists.</p>';
                    $db = null;
                }
                // if no dupe is found
                else
                {                    
                    // save new team
                    $sql = "INSERT INTO iglSchedule (iglTeamId, opponent, week, stream, gameWins, gameLosses) VALUES (:iglTeamId, :opponent, :week, :stream, :gameWins, :gameLosses)";
                    $cmd = $db->prepare($sql);
                    $cmd->bindParam(':iglTeamId', $iglTeamId, PDO::PARAM_INT);
                    $cmd->bindParam(':opponent', $opponent, PDO::PARAM_STR, 30);
                    $cmd->bindParam(':week', $week, PDO::PARAM_INT);
                    $cmd->bindParam(':stream', $stream, PDO::PARAM_STR, 100);
                    $cmd->bindParam(':gameWins', $gameWins, PDO::PARAM_INT);
                    $cmd->bindParam(':gameLosses', $gameLosses, PDO::PARAM_INT);
                    
                    $cmd->execute();
                    
                    // disconnect from sql
                    $db = null;
                    
                    echo '<div class="alert alert-info">Game Created.  
                        <a href="igl-team-details.php?iglTeamId='. $iglTeamId . '">To Team Page</a>
                    </div>';
                }
            }
            //// edit team ////
            else
            {
                // check for id
                $sql = "SELECT * FROM iglSchedule WHERE scheduleId = :scheduleId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':scheduleId', $scheduleId, PDO::PARAM_INT);
                $cmd->execute();
                $game = $cmd->fetch();
                
                // if game found
                if($game)
                {
                    // sql update command
                    $sql = "UPDATE iglSchedule SET iglTeamId = :iglTeamId, opponent = :opponent, week = :week, stream = :stream, gameWins = :gameWins, gameLosses = :gameLosses WHERE scheduleId = :scheduleId";
                    $cmd = $db->prepare($sql);
                    $cmd->bindParam(':iglTeamId', $iglTeamId, PDO::PARAM_INT);
                    $cmd->bindParam(':opponent', $opponent, PDO::PARAM_STR, 30);
                    $cmd->bindParam(':week', $week, PDO::PARAM_INT);
                    $cmd->bindParam(':stream', $stream, PDO::PARAM_STR, 100);
                    $cmd->bindParam(':gameWins', $gameWins, PDO::PARAM_INT);
                    $cmd->bindParam(':gameLosses', $gameLosses, PDO::PARAM_INT);
                    

                    if (!empty($scheduleId)) 
                    {
                        $cmd->bindParam(':scheduleId', $scheduleId, PDO::PARAM_INT);
                    }

                    $cmd->execute();

                    $db = null;

                    echo '<div class="alert alert-info">Game Saved.  
                        <a href="index.php">To Home</a>
                    </div>';
                }
            }
        }
    }
    catch (Exception $error)
    {
        
    }
?>
</body>
<?php
    require 'includes/footer.php';
?>
</html>