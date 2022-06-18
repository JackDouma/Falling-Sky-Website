<!-- get header -->
<?php
    $title = 'Edit Team Record';
    require 'includes/header.php';
    require 'includes/admin-auth.php';

    try
    {
        $iglTeamId = null;
        $teamName = null;
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
                $sql = "SELECT * FROM iglTeams WHERE iglTeamId= :iglTeamId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':iglTeamId', $iglTeamId, PDO::PARAM_INT);
                $cmd->execute();
                $team = $cmd->fetch(); 

                // if team found, get values
                if (!empty($team))
                {
                    $iglTeamId = $team['iglTeamId'];
                    $teamName = $team['teamName'];
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

<main class="container">
    <h1>Team Record Edit</h1>

    <form method="post" action="save-record.php">

        <!-- team name -->
        <fieldset class="m-1">
            <label for="teamName" class="col-2">Team Name:</label>
            <select name="teamName" id="teamName">
                <option value=""></option>
                <?php
                    try 
                    {
                        // this php code will get and show all teams that have been created
                        require 'includes/db.php';

                        $sql = "SELECT * FROM iglTeams";

                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $teams = $cmd->fetchAll();

                        foreach ($teams as $team) 
                        {         
                            if ($teamName == $team['teamName'])   
                            {
                                echo '<option selected value="' . $team['teamName'] . '">' . $team['teamName'] . '</option>'; 
                            }     
                            else
                            {
                                echo '<option value="' . $team['teamName'] . '">' . $team['teamName'] . '</option>'; 
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

        <!-- wins -->
        <fieldset class="m-1">
            <label for="seriesWins" class="col-2">Wins:</label>
            <input name="seriesWins" id="seriesWins" value="<?php echo $seriesWins; ?>" />
        </fieldset>

        <!-- losses -->
        <fieldset class="m-1">
            <label for="seriesLosses" class="col-2">Losses:</label>
            <input name="seriesLosses" id="seriesLosses" value="<?php echo $seriesLosses; ?>" />
        </fieldset>

        <!-- losses -->
        <fieldset class="m-1">
            <label for="placement" class="col-2">Placement(1st, 9th-16th, etc):</label>
            <input name="placement" id="placement" value="<?php echo $placement; ?>" />
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