<?php
    $title = 'Home';
    require 'includes/header.php';
?>

    <!-- masthead -->
    <section class="i-masthead">
        <div>
            
        </div>
    </section>

    <!-- section 1 - welcome -->
    <section class="i-row-one">
        <h2>About Us</h2>

        <div>
            <p>We are a fairly new organization, we started back in 2021 with a focus on Rocket League in the Indy Gaming League. 
            We have teams ranking from platinum, all the way up to high GC teams. We are always welcoming anyone into our organization to either play for us, 
            help out with administration, or even just to chat it up. We are so thankful to everyone who has helped out already, 
            and to you for even being here on the website. Check us out on social media, join the discord, or contact us for inquires. 
            We look forward to hearing from you! #TheSkysTheLimit</p>
        </div>           
    </section>

    <!-- section 2 - schedule -->
    <section class="i-row-two">
    <h1 class="container text-center">IGL Game List</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Match</th>
                <th>Season</th>
                <th>Week</th>
                <th>Gamemode</th>
                <th>Tier</th>
                <th>Stream</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
                try
                {
                    // connect sql
                    require 'includes/db.php';

                    // get table
                    $sql = "SELECT * FROM iglSchedule";
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $games = $cmd->fetchAll();

                    $sql = "SELECT * FROM iglTeams";
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $teams = $cmd->fetchAll();

                    $sql = "SELECT * FROM seasons";
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $seasons = $cmd->fetchAll();

                    $sql = "SELECT * FROM currentWeek";
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $currentWeek = $cmd->fetchAll();

                    // loops through data and creates table
                    foreach ($currentWeek as $week)
                    {                   
                        foreach ($seasons as $season)
                        {   
                            if ($season['seasonId'] == $week['seasonId'])
                            {                       
                                foreach ($teams as $team)
                                {     
                                    // if season == team season is playing in
                                    if ($team['seasonId'] == $week['seasonId'])
                                    {     
                                        foreach ($games as $game)
                                        {                    
                                                    
                                            // if team == team with a match
                                            if ($team['iglTeamId'] == $game['iglTeamId'] && $game['week'] == $week['week'])
                                            {
                                                echo 
                                                '<tr>
                                                    <td>' . $team['teamName'] . ' VS ' . $game['opponent'] . '</td>
                                                    <td>' . $season['seasonName'] . '</td>
                                                    <td>' . $game['week'] . '</td>
                                                    <td>' . $team['mode'] . '</td>
                                                    <td>' . $team['tier'] . '</td>';

                                                    if (!empty($game['stream']))
                                                    {
                                                        echo '<td>
                                                            <a href="' . $game['stream'] . '" class="btn btn-info" id="stream link" target="_blank">Stream Link</a>
                                                        </td>';
                                                    }
                                                    else
                                                    {
                                                        echo '<td>No Stream :(</td>';
                                                    }

                                                    if ($game['gameWins'] > 0 || $game['gameLosses'] > 0)
                                                    {
                                                        echo '<td>' . $game['gameWins'] . '-' . $game['gameLosses'] . '</td>';
                                                    }
                                                    else
                                                    {
                                                        echo '<td>TBD</td>';
                                                    }
                                                echo '</tr>';
                                            }                                
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $db = null;
                }
                // if site is unable to load
                catch (Exception $error)
                {
                    header('location:error.php');
                }
            ?>
        </tbody>
    </table>
</section>


    <!-- section 3 - merch -->
    <section class="i-row-three">
        <h2>Our Merchandise</h2>

        <img src="img\merch.png" id="merch">
        <a href="https://realgamerwear.net/teams/falling-sky-esports/" id="merchlink" target="_blank">SHOP</a>
    </section>

</body>
<?php
    require 'includes/footer.php';
?>
</html>