<?php
    $title = 'IGL Team Create';
    require 'includes/header.php';
    require 'includes/admin-auth.php';

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
    <h1>IGL Team Create</h1>

    <form method="post" action="save-igl-team.php">

        <!-- name -->
        <fieldset class="m-1">
            <label for="teamName" class="col-2">Team Name:</label>
            <input name="teamName" id="teamName" required maxlength="25" value="<?php echo $teamName; ?>" />
        </fieldset>

        <!-- mode -->
        <fieldset class="m-1">
            <label for="mode" class="col-2">Gamemode:</label>
            <select name="mode" id="mode">
            <option value="<?php echo $mode; ?>"><?php echo $mode; ?></option>
            <option value="3v3">3v3</option>
            <option value="2v2">2v2</option>
            <option value="1v1">1v1</option>
            <option value="other">other</option>
            </select>
        </fieldset>

        <!-- tier -->
        <fieldset class="m-1">
            <label for="tier" class="col-2">Tier:</label>
            <select name="tier" id="tier">
            <option value="<?php echo $tier; ?>"><?php echo $tier; ?></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            </select>
        </fieldset>

        <!-- season -->
        <fieldset class="m-1">
            <label for="seasonId" class="col-2">Season:</label>
            <select name="seasonId" id="seasonId">
                <option value=""></option>
                <?php
                    try 
                    {
                        // this php code will get and show all seasons that have been created
                        require 'includes/db.php';

                        $sql = "SELECT * FROM seasons";

                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $seasons = $cmd->fetchAll();

                        foreach ($seasons as $season) 
                        {          
                            if ($seasonId == $season['seasonId'])
                            {
                                echo '<option selected value="' . $season['seasonId'] . '">' . $season['seasonName'] . '</option>';    
                            }   
                            else
                            {
                                echo '<option value="' . $season['seasonId'] . '">' . $season['seasonName'] . '</option>';    
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

        <!-- captain -->
        <fieldset class="m-1">
            <label for="captain" class="col-2">Captain:</label>
            <select name="captain" id="captain">
                <option value=""></option>
                <?php
                    try 
                    {
                        // this php code will get and show all players that have been created
                        require 'includes/db.php';

                        $sql = "SELECT * FROM iglPlayers ORDER BY name ASC";

                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $players = $cmd->fetchAll();
                     
                        foreach ($players as $player) 
                        {         
                            if ($captain == $player['iglPlayerId'])   
                            {
                                echo '<option selected value="' . $player['iglPlayerId'] . '">' . $player['name'] . '</option>'; 
                            }     
                            else
                            {
                                echo '<option value="' . $player['iglPlayerId'] . '">' . $player['name'] . '</option>'; 
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

        <!-- player1 -->
        <fieldset class="m-1">
            <label for="player1" class="col-2">Player 1 (optional):</label>
            <select name="player1" id="player1">
                <option value=""></option>
                <?php
                    try 
                    {
                        foreach ($players as $player) 
                        {         
                            if ($player1 == $player['iglPlayerId'])   
                            {
                                echo '<option selected value="' . $player['iglPlayerId'] . '">' . $player['name'] . '</option>'; 
                            }     
                            else
                            {
                                echo '<option value="' . $player['iglPlayerId'] . '">' . $player['name'] . '</option>'; 
                            }            
                        }
                    }
                    catch (Exception $error) 
                    {
                        header('location:error.php');
                    }
                ?>
            </select>
        </fieldset>

        <!-- player2 -->
        <fieldset class="m-1">
            <label for="player2" class="col-2">Player 2 (optional):</label>
            <select name="player2" id="player2">
                <option value=""></option>
                <?php
                    try 
                    {
                        foreach ($players as $player) 
                        {         
                            if ($player2 == $player['iglPlayerId'])   
                            {
                                echo '<option selected value="' . $player['iglPlayerId'] . '">' . $player['name'] . '</option>'; 
                            }     
                            else
                            {
                                echo '<option value="' . $player['iglPlayerId'] . '">' . $player['name'] . '</option>'; 
                            }            
                        }
                    }
                    catch (Exception $error) 
                    {
                        header('location:error.php');
                    }
                ?>
            </select>
        </fieldset>

        <!-- player3 -->
        <fieldset class="m-1">
            <label for="player3" class="col-2">Player 3 (optional):</label>
            <select name="player3" id="player3">
                <option value=""></option>
                <?php
                    try 
                    {
                        foreach ($players as $player) 
                        {         
                            if ($player3 == $player['iglPlayerId'])   
                            {
                                echo '<option selected value="' . $player['iglPlayerId'] . '">' . $player['name'] . '</option>'; 
                            }     
                            else
                            {
                                echo '<option value="' . $player['iglPlayerId'] . '">' . $player['name'] . '</option>'; 
                            }            
                        }
                    }
                    catch (Exception $error) 
                    {
                        header('location:error.php');
                    }
                ?>
            </select>
        </fieldset>

        <!-- player4 -->
        <fieldset class="m-1">
            <label for="player4" class="col-2">Player 4 (optional):</label>
            <select name="player4" id="player4">
                <option value=""></option>
                <?php
                    try 
                    {
                        foreach ($players as $player) 
                        {         
                            if ($player4 == $player['iglPlayerId'])   
                            {
                                echo '<option selected value="' . $player['iglPlayerId'] . '">' . $player['name'] . '</option>'; 
                            }     
                            else
                            {
                                echo '<option value="' . $player['iglPlayerId'] . '">' . $player['name'] . '</option>'; 
                            }            
                        }

                       
                    }
                    catch (Exception $error) 
                    {
                        header('location:error.php');
                    }
                ?>
            </select>
        </fieldset>

        <!-- submit button -->
        <div class="offset-2">
            <input type="hidden" name="iglTeamId" id="iglTeamId" value="<?php echo $iglTeamId; ?>" />
            <button>Save</button>
        </div>
    </form>
</main>

</body>
<?php
    require 'includes/footer.php';
?>
</html>