<!-- get header -->
<?php
    $title = 'IGL Team Create';
    require 'includes/header.php';

    // make sure user is logged in
    if(empty($_SESSION['adminName']))
    {
        header('location:admin-login.php');
    }
?>

<main class="container">
    <h1>IGL Team Create</h1>

    <form method="post" action="save-igl-team.php">

        <!-- name -->
        <fieldset class="m-1">
            <label for="teamName" class="col-2">Team Name:</label>
            <input name="teamName" id="teamName" required maxlength="25" />
        </fieldset>

        <!-- mode -->
        <fieldset class="m-1">
            <label for="mode" class="col-2">Gamemode:</label>
            <select name="mode" id="mode">
            <option value="3v3" selected>3v3</option>
            <option value="2v2">2v2</option>
            <option value="1v1">1v1</option>
            <option value="other">other</option>
            </select>
        </fieldset>

        <!-- tier -->
        <fieldset class="m-1">
            <label for="tier" class="col-2">Tier:</label>
            <select name="tier" id="tier">
            <option value="1" selected>1</option>
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
                            if ($season['seasonId'] == $seasonId) 
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
                            if ($player['iglPlayerId'] == $iglPlayerId) 
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
                            if ($player['iglPlayerId'] == $iglPlayerId) 
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

        <!-- player2 -->
        <fieldset class="m-1">
            <label for="player2" class="col-2">Player 2 (optional):</label>
            <select name="player2" id="player2">
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
                            if ($player['iglPlayerId'] == $iglPlayerId) 
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

        <!-- player3 -->
        <fieldset class="m-1">
            <label for="player3" class="col-2">Player 3 (optional):</label>
            <select name="player3" id="player3">
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
                            if ($player['iglPlayerId'] == $iglPlayerId) 
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

        <!-- captain -->
        <fieldset class="m-1">
            <label for="player4" class="col-2">Player 4 (optional):</label>
            <select name="player4" id="player4">
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
                            if ($player['iglPlayerId'] == $iglPlayerId) 
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

        <!-- submit button -->
        <div class="offset-2">
            <button>Create</button>
        </div>
    </form>
</main>

</body>
<?php
    require 'includes/footer.php';
?>
</html>