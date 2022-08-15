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
            <h3>Player Info</h3>
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
    </section>


</body>
<?php
    require 'includes/footer.php';
?>
</html>