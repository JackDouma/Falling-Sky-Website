<?php
    $title = 'New IGL Game';
    require 'includes/header.php';
    require 'includes/captain-auth.php';

    try
    {
        $scheduleId = null;
        $iglTeamId = null;
        $opponent = null;
        $week = null;
        $stream = null;
        $gameWins = null;
        $gameLosses = null;
        
        if (isset($_GET['scheduleId'])) 
        {
            if (is_numeric($_GET['scheduleId'])) 
            {
                $scheduleId = $_GET['scheduleId'];

                // connect sql
                require 'includes/db.php';

                // run sql command and get webpage details
                $sql = "SELECT * FROM iglSchedule WHERE scheduleId = :scheduleId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':scheduleId', $scheduleId, PDO::PARAM_INT);
                $cmd->execute();
                $schedule = $cmd->fetch(); 

                // if team found, get values
                if (!empty($schedule))
                {
                    $scheduleId = $schedule['scheduleId'];
                    $iglTeamId = $schedule['iglTeamId'];
                    $opponent = $schedule['opponent'];
                    $seasonId = $schedule['seasonId'];
                    $week = $schedule['week'];
                    $stream = $schedule['stream'];
                    $gameWins = $schedule['gameWins'];
                    $gameLosses = $schedule['gameLosses'];

                    $db = null;
                }
                // if not found
                else
                {
                    $db = null;
                    header('location:error.php');
                    exit();
                }
            }
        }
    }
    // if site is unable to load
    catch (Exception $error)
    {
        header('location:error.php');
    }
?>

<main class="container">
    <h1>Save IGL Game</h1>

    <form method="post" action="save-igl-game.php">

       <!-- team -->
       <fieldset class="m-1">
            <label for="iglTeamId" class="col-2">Team:</label>
            <select name="iglTeamId" id="iglTeamId" required>
                <option value=""></option>
                <?php
                    try 
                    {
                        // this php code will get and show all players that have been created
                        require 'includes/db.php';

                        $sql = "SELECT * FROM iglTeams";

                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $teams = $cmd->fetchAll();

                        $sql = "SELECT * FROM seasons";

                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $seasons = $cmd->fetchAll();

                        foreach ($seasons as $season)
                        {
                            foreach ($teams as $team) 
                            {         
                                if ($team['seasonId'] == $season['seasonId'])
                                {                                
                                    if ($iglTeamId == $team['iglTeamId'])   
                                    {
                                        echo '<option selected value="' . $team['iglTeamId'] . '">' . $season['seasonName'] . ' ' . $team['teamName'] . ' ' . $team['mode'] . '</option>'; 
                                    }     
                                    else
                                    {
                                        echo '<option value="' . $team['iglTeamId'] . '">' . $season['seasonName'] . ' ' . $team['teamName'] . ' ' . $team['mode'] . '</option>'; 
                                    } 
                                }           
                            }
                        }

                        $db = null;
                    }
                    catch (Exception $error) 
                    {
                        header('location:error.php');
                    }
                ?>
            </select>
        </fieldset>

        <!-- opponent -->
        <fieldset class="m-1">
            <label for="opponent" class="col-2">Opponent:</label>
            <input name="opponent" id="opponent" required maxlength="30" value="<?php echo $opponent; ?>" />
        </fieldset>

        <!-- week -->
        <fieldset class="m-1">
            <label for="week" class="col-2">Week:</label>
            <select name="week" id="week" required>
            <option value="<?php echo $week; ?>"><?php echo $week; ?></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            </select>
        </fieldset>

        <!-- stream -->
        <fieldset class="m-1">
            <label for="stream" class="col-2">Stream(optional):</label>
            <input name="stream" id="stream" maxlength="100" value="<?php echo $stream; ?>" />
        </fieldset>

        <!-- wins -->
        <fieldset class="m-1">
            <label for="gameWins" class="col-2">Game Wins(optional):</label>
            <input name="gameWins" id="gameWins" value="<?php echo $gameWins; ?>" />
        </fieldset>

        <!-- losses -->
        <fieldset class="m-1">
            <label for="gameLosses" class="col-2">Game Losses(optional):</label>
            <input name="gameLosses" id="gameLosses" value="<?php echo $gameLosses; ?>" />
        </fieldset>

        <!-- submit button -->
        <div class="offset-2">
            <input type="hidden" name="scheduleId" id="scheduleId" value="<?php echo $scheduleId; ?>" />
            <button>Save</button>
        </div>
    </form>
</main>

</body>
<?php
    require 'includes/footer.php';
?>
</html>