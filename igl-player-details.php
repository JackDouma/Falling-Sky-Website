<?php
    $title = 'Player Details';
    require 'includes/header.php';

    try
    {
        $iglPlayerId = null;
        $name = null;
        $bio = null;
        $tier = null;
        $wins = null;
        $losses = null;
        $circuits = 0;
        $golds = 0;
        $silvers = 0;
        $bronzes = 0;

        
        if (isset($_GET['iglPlayerId'])) 
        {
            if (is_numeric($_GET['iglPlayerId'])) 
            {
                $iglPlayerId = $_GET['iglPlayerId'];

                // connect sql
                require 'includes/db.php';

                // run sql command and get webpage details
                $sql = "SELECT * FROM iglPlayers WHERE iglPlayerId = :iglPlayerId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':iglPlayerId', $iglPlayerId, PDO::PARAM_INT);
                $cmd->execute();
                $player = $cmd->fetch(); 

                // if player found, get values
                if (!empty($player))
                {
                    $iglPlayerId = $player['iglPlayerId'];
                    $name = $player['name'];
                    $bio = $player['bio'];
                    $tier = $player['tier'];

                    $db = null;
                    require 'includes/db.php';

                    $sql = "SELECT * FROM iglTeams";
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $teams = $cmd->fetchAll();

                    // loop threw every team and add wins and losses where player has played for that team
                    foreach ($teams as $team) 
                    {
                        if ($iglPlayerId == $team['captain'] || $iglPlayerId == $team['player1'] || $iglPlayerId == $team['player2'] || $iglPlayerId == $team['player3'] || $iglPlayerId == $team['player4'])
                        {
                            $wins += $team['seriesWins'];
                            $losses += $team['seriesLosses'];
                            $circuits++;

                            if($team['placement'] == "1st")
                            {
                                $golds++;
                            }
                            else if($team['placement'] == "2nd")
                            {
                                $silvers++;
                            }
                            else if($team['placement'] == "3rd")
                            {
                                $bronzes++;
                            }
                        }
                    }
                    $db = null;

                    $winrate = round($wins / ($wins + $losses) * 100);
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

    <section class="pd-title">
        <h1><?php echo $name; ?></h1>
        <h6><?php echo $bio; ?></h6>
    </section>

    <!-- section 1 - player info -->
    <section class="pd-row-one">
        <div>
            <h3>Stats</h3>
            <div>
                <h5>
                    <?php echo 'Tier: ' . $tier; ?>
                </h5>
            </div>
            <div>
                <h5>
                    <?php echo 'Wins: ' . $wins; ?>
                </h5>
            </div>
            <div>
                <h5>
                    <?php echo 'Losses: ' . $losses; ?>
                </h5>
            </div>
            <div>
                <h5>
                    <?php echo 'Winrate: ' . $winrate . '%'; ?>
                </h5>
            </div>
        </div>

        <div>
            <h3>Accolades</h3>
            <div>
                <h5>
                    <?php echo 'Circuits: ' . $circuits; ?>
                </h5>
            </div>
            <div>    
                <h5>
                    <?php echo 'Golds: ' . $golds; ?>
                </h5>
            </div>
            <div>
                <h5>
                    <?php echo 'Silvers: ' . $silvers; ?>
                </h5>
            </div>
            <div>
                <h5>
                    <?php echo 'Bronzes: ' . $bronzes; ?>
                </h5>
            </div>
        </div>
    </section>


    <section class="pd-row-one">
        <div>
            <h3>Upcoming Games</h3>
            <?php
                require 'includes/db.php';

                $sql = "SELECT * FROM iglSchedule";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $playerGames = $cmd->fetchAll();

                $db = null;
                require 'includes/db.php';

                $sql = "SELECT * FROM currentWeek";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $currentWeek = $cmd->fetchAll();

                foreach ($currentWeek as $week)
                {
                    foreach($teams as $team)
                    {
                        if ($iglPlayerId == $team['captain'] || $iglPlayerId == $team['player1'] || $iglPlayerId == $team['player2'] || $iglPlayerId == $team['player3'] || $iglPlayerId == $team['player4'])
                        {
                            foreach ($playerGames as $playerGame)
                            {
                                if($team['iglTeamId'] == $playerGame['iglTeamId'])
                                {
                                    if($week['week'] == $playerGame['week'])
                                    {
                                        if($playerGame['gameWins'] == 0 && $playerGame['gameLosses'] == 0)
                                        {
                                            echo '<div>';                                               
                                                echo '<h6><em>';
                                                    echo '<a href="igl-team-details.php?iglTeamId='. $team['iglTeamId'] . '">' . $team['teamName'] . '</a> VS ' . $playerGame['opponent'];
                                                echo '</em></h6>';
                                                echo '<h6>';
                                                    if ($playerGame['time'] == NULL)
                                                    {
                                                        echo 'Time: TBD';
                                                    }
                                                    else
                                                    {
                                                        echo 'Time: ' . $playerGame['time'];
                                                    }
                                                echo '</h6>';
                                                echo '<h6>';
                                                    if ($playerGame['stream'] == NULL)
                                                    {
                                                        echo 'Stream: TBD';
                                                    }
                                                    else
                                                    {
                                                        
                                                        echo 'Stream: <a href="' . $playerGame['stream'] . '" id="stream link" target="_blank">Link</a>';
                                                    }
                                                echo '</h6>';
                                            echo '</div>';
                                            echo '<br>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            ?>
           
        </div>

        <div>
            <h3>Recent Games</h3>
            <?php
                require 'includes/db.php';
                $playerGames = NULL;
                $sql = "SELECT * FROM iglSchedule ORDER BY scheduleId DESC";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $playerGames = $cmd->fetchAll();

                $db = null;
                $recentGames = 0;
                
                foreach ($playerGames as $playerGame)
                {                   
                    foreach($teams as $team)
                    {
                        if ($iglPlayerId == $team['captain'] || $iglPlayerId == $team['player1'] || $iglPlayerId == $team['player2'] || $iglPlayerId == $team['player3'] || $iglPlayerId == $team['player4'])
                        {
                            if($team['iglTeamId'] == $playerGame['iglTeamId'])
                            {
                                if($recentGames < 8)
                                {
                                    if($playerGame['gameWins'] > 0 || $playerGame['gameLosses'] > 0)
                                    {
                                        echo '<div>';                                               
                                            echo '<h6><em>';
                                                echo '<a href="igl-team-details.php?iglTeamId='. $team['iglTeamId'] . '">' . $team['teamName'] . '</a> VS ' . $playerGame['opponent'];
                                            echo '</em></h6>';
                                            echo '<h6>';
                                                echo 'Result: ' . $playerGame['gameWins'] . '-' . $playerGame['gameLosses'];
                                            echo '</h6>';
                                        echo '</div>';
                                        echo '<br>';

                                        $recentGames++;
                                    }
                                }
                            }
                        }                           
                    }                 
                }              
            ?>
        </div>
    </section>


</body>
<?php
    require 'includes/footer.php';
?>
</html>