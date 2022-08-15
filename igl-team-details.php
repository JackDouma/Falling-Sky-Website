<?php
    $title = 'Team Details';
    require 'includes/header.php';

    try
    {
        $iglTeamId = null;
        $teamName = null;
        $mode = null;
        $tier = null;
        $seasonId = null;
        $captain = null;
        $player1 = null;
        $player2 = null;
        $player3 = null;
        $player4 = null;
        $seriesWins = null;
        $seriesLosses = null;
        $placement = null;
        
        if (isset($_GET['iglTeamId'])) 
        {
            if (is_numeric($_GET['iglTeamId'])) 
            {
                $iglTeamId = $_GET['iglTeamId'];

                // connect sql
                require 'includes/db.php';

                // run sql command and get webpage details
                $sql = "SELECT * FROM iglTeams WHERE iglTeamId = :iglTeamId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':iglTeamId', $iglTeamId, PDO::PARAM_INT);
                $cmd->execute();
                $team = $cmd->fetch(); 

                // if team found, get values
                if (!empty($team))
                {
                    $iglTeamId = $team['iglTeamId'];
                    $teamName = $team['teamName'];
                    $mode = $team['mode'];
                    $tier = $team['tier'];
                    $seasonId = $team['seasonId'];
                    $captain = $team['captain'];
                    $player1 = $team['player1'];
                    $player2 = $team['player2'];
                    $player3 = $team['player3'];
                    $player4 = $team['player4'];
                    $seriesWins = $team['seriesWins'];
                    $seriesLosses = $team['seriesLosses'];
                    $placement = $team['placement'];

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

    <section class="td-title">
        <div>
            <h1><?php echo $teamName; ?></h1>
        </div>
    </section>
    <!-- section 1 - players -->
    <section class="td-row-one">
        <div>
            <h3>Players</h3>

            <?php
                try 
                {
                    // this php code will get and show all players that have been created
                    require 'includes/db.php';

                    $sql = "SELECT * FROM iglPlayers";

                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $players = $cmd->fetchAll();

                    foreach ($players as $player) 
                    {         
                        if ($captain == $player['iglPlayerId'])   
                        {
                            echo '<div>';
                                echo '<h5>';
                                    echo 'Captain: <a href=igl-player-details.php?iglPlayerId=' . $player['iglPlayerId'] . '>' . $player['name'] . '</a>';
                                echo '</h5>';
                            echo '</div>';
                        }  
                    }
                    foreach ($players as $player) 
                    {
                        if ($player1 == $player['iglPlayerId'])   
                        {
                            echo '<div>';
                                echo '<h5>';
                                    echo '<a href=igl-player-details.php?iglPlayerId=' . $player['iglPlayerId'] . '>' . $player['name'] . '</a>';
                                echo '</h5>';
                            echo '</div>';
                        } 
                        else if ($player2 == $player['iglPlayerId'])   
                        {
                            echo '<div>';
                                echo '<h5>';
                                    echo '<a href=igl-player-details.php?iglPlayerId=' . $player['iglPlayerId'] . '>' . $player['name'] . '</a>';
                                echo '</h5>';
                            echo '</div>';
                        } 
                        else if ($player3 == $player['iglPlayerId'])   
                        {
                            echo '<div>';
                                echo '<h5>';
                                    echo '<a href=igl-player-details.php?iglPlayerId=' . $player['iglPlayerId'] . '>' . $player['name'] . '</a>';
                                echo '</h5>';
                            echo '</div>';
                        } 
                        else if ($player4 == $player['iglPlayerId'])   
                        {
                            echo '<div>';
                                echo '<h5>';
                                    echo '<a href=igl-player-details.php?iglPlayerId=' . $player['iglPlayerId'] . '>' . $player['name'] . '</a>';
                                echo '</h5>';
                            echo '</div>';
                        }             
                    }

                    $db = null;
                }
                catch (Exception $error) 
                {
                    header('location:error.php');
                }
            ?>  
        </div>
        <div>
            <h3>Team Info</h3>
            <div>
                <h5>
                    <?php echo 'Wins: ' . $seriesWins; ?>
                </h5>
            </div>
            <div>
                <h5>
                    <?php echo 'Losses: ' . $seriesLosses; ?>
                </h5>
            </div>
            <div>
                <h5>
                    <?php 
                        if (empty($placement))
                        {
                            echo 'Placement: TBD';
                        }
                        else
                        {
                            echo 'Placement: ' . $placement; 
                        }
                    ?>
                </h5>
            </div>
            <div>
                <h5>
                    <?php echo 'Mode: ' . $mode; ?>
                </h5>
            </div>
            <div>
                <h5>
                    <?php echo 'Tier: ' . $tier; ?>
                </h5>
            </div>
        </div>            
    </section>

    <section class="td-title">
        <div>
            <h2>Schedule</h2>
        </div>
    </section>

    <!-- section 2 - schedule-->
    <section class="td-row-one">
        <div>
            <h3>Season</h3>

            <?php
                try 
                {
                    // this php code will get and show all games that have been created
                    require 'includes/db.php';

                    $sql = "SELECT * FROM iglSchedule";
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $games = $cmd->fetchAll();

                    foreach ($games as $game) 
                    {         
                        if ($iglTeamId == $game['iglTeamId'])   
                        {
                            if ($game['week'] == '1')
                            {
                                echo '<div>';
                                    echo '<h5>Week 1</h5>';
                                    echo '<h6>';
                                        echo $teamName . ' VS ' . $game['opponent'];
                                    echo '</h6>';
                                    echo '<h6>';
                                        echo $game['gameWins'] . '-' . $game['gameLosses'];
                                    echo '</h6>';
                                echo '</div>';
                            }
                        }
                    }
                    foreach ($games as $game) 
                    {         
                        if ($iglTeamId == $game['iglTeamId'])   
                        {
                            if ($game['week'] == '2')
                            {
                                echo '<div>';
                                    echo '<h5>Week 2</h5>';
                                    echo '<h6>';
                                        echo $teamName . ' VS ' . $game['opponent'];
                                    echo '</h6>';
                                    echo '<h6>';
                                        echo $game['gameWins'] . '-' . $game['gameLosses'];
                                    echo '</h6>';
                                echo '</div>';
                            }
                        }
                    }
                    foreach ($games as $game) 
                    {         
                        if ($iglTeamId == $game['iglTeamId'])   
                        {
                            if ($game['week'] == '3')
                            {
                                echo '<div>';
                                    echo '<h5>Week 3</h5>';
                                    echo '<h6>';
                                        echo $teamName . ' VS ' . $game['opponent'];
                                    echo '</h6>';
                                    echo '<h6>';
                                        echo $game['gameWins'] . '-' . $game['gameLosses'];
                                    echo '</h6>';
                                echo '</div>';
                            }
                        }
                    }
                    foreach ($games as $game) 
                    {         
                        if ($iglTeamId == $game['iglTeamId'])   
                        {
                            if ($game['week'] == '4')
                            {
                                echo '<div>';
                                    echo '<h5>Week 4</h5>';
                                    echo '<h6>';
                                        echo $teamName . ' VS ' . $game['opponent'];
                                    echo '</h6>';
                                    echo '<h6>';
                                        echo $game['gameWins'] . '-' . $game['gameLosses'];
                                    echo '</h6>';
                                echo '</div>';
                            }
                        }
                    }
                    foreach ($games as $game) 
                    {         
                        if ($iglTeamId == $game['iglTeamId'])   
                        {
                            if ($game['week'] == '5')
                            {
                                echo '<div>';
                                    echo '<h5>Week 5</h5>';
                                    echo '<h6>';
                                        echo $teamName . ' VS ' . $game['opponent'];
                                    echo '</h6>';
                                    echo '<h6>';
                                        echo $game['gameWins'] . '-' . $game['gameLosses'];
                                    echo '</h6>';
                                echo '</div>';
                            }
                        }
                    }
                    foreach ($games as $game) 
                    {         
                        if ($iglTeamId == $game['iglTeamId'])   
                        {
                            if ($game['week'] == '6')
                            {
                                echo '<div>';
                                    echo '<h5>Week 6</h5>';
                                    echo '<h6>';
                                        echo $teamName . ' VS ' . $game['opponent'];
                                    echo '</h6>';
                                    echo '<h6>';
                                        echo $game['gameWins'] . '-' . $game['gameLosses'];
                                    echo '</h6>';
                                echo '</div>';
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
        </div> 
        <div>
            <h3>Playoffs</h3>

            <?php
                try 
                {
                    foreach ($games as $game) 
                    {         
                        if ($iglTeamId == $game['iglTeamId'])   
                        {
                            if ($game['week'] == '7')
                            {
                                echo '<div>';
                                    echo '<h5>Round of 16</h5>';
                                    echo '<h6>';
                                        echo $teamName . ' VS ' . $game['opponent'];
                                    echo '</h6>';
                                    echo '<h6>';
                                        echo $game['gameWins'] . '-' . $game['gameLosses'];
                                    echo '</h6>';
                                echo '</div>';
                            }
                        }
                    }  
                    foreach ($games as $game) 
                    {         
                        if ($iglTeamId == $game['iglTeamId'])   
                        {
                            if ($game['week'] == '8')
                            {
                                echo '<div>';
                                    echo '<h5>Quarter Finals</h5>';
                                    echo '<h6>';
                                        echo $teamName . ' VS ' . $game['opponent'];
                                    echo '</h6>';
                                    echo '<h6>';
                                        echo $game['gameWins'] . '-' . $game['gameLosses'];
                                    echo '</h6>';
                                echo '</div>';
                            }
                        }
                    } 
                    foreach ($games as $game) 
                    {         
                        if ($iglTeamId == $game['iglTeamId'])   
                        {
                            if ($game['week'] == '9')
                            {
                                echo '<div>';
                                    echo '<h5>Semi Finals</h5>';
                                    echo '<h6>';
                                        echo $teamName . ' VS ' . $game['opponent'];
                                    echo '</h6>';
                                    echo '<h6>';
                                        echo $game['gameWins'] . '-' . $game['gameLosses'];
                                    echo '</h6>';
                                echo '</div>';

                                // determine if there's a 3rd place or 1st place match
                                if ($game['gameWins'] > $game['gameLosses'])
                                {
                                    $lastmatch = 'Finals';
                                }
                                else
                                {
                                    $lastmatch = 'Bronze Match';
                                }
                            }
                        }
                    } 
                    foreach ($games as $game) 
                    {         
                        if ($iglTeamId == $game['iglTeamId'])   
                        {
                            if ($game['week'] == '10')
                            {
                                echo '<div>';
                                    echo '<h5>'. $lastmatch .'</h5>';
                                    echo '<h6>';
                                        echo $teamName . ' VS ' . $game['opponent'];
                                    echo '</h6>';
                                    echo '<h6>';
                                        echo $game['gameWins'] . '-' . $game['gameLosses'];
                                    echo '</h6>';
                                echo '</div>';
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
        </div>          
    </section>
    
    <!-- section 3 - edit -->
    <section class="td-row-three">
        <?php
            if (session_status() == PHP_SESSION_NONE)
            {
                session_start();
            }
            
            // check session for admin
            if($_SESSION['type'] == 1 || $_SESSION['type'] == 2)
            {
                echo '<a href="edit-record.php?iglTeamId=' . $iglTeamId . '">Edit Record</a>';
                echo '<a href="add-igl-game.php?iglTeamId=' . $iglTeamId . '">Add Game</a>';
            }
        ?>
    </section>
</body>
<?php
    require 'includes/footer.php';
?>
</html>