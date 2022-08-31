<?php
    $title = 'Home';
    require 'includes/header.php';
?>

    <!-- masthead -->
    <section class="masthead">
        <div>
            <h1>FALLING SKY ESPORTS</h1>
        </div>
    </section>

    <div class="new-section"></div>

    <!-- section 1 - about -->
    <section class="textbox">
        <h2>About Us</h2>

        <div>
            <p>**TO BE CHANGED**We are a fairly new organization, we started back in 2021 with a focus on Rocket League in the Indy Gaming League. 
            We have teams ranking from platinum, all the way up to high GC teams. We are always welcoming anyone into our organization to either play for us, 
            help out with administration, or even just to chat it up. We are so thankful to everyone who has helped out already, 
            and to you for even being here on the website. Check us out on social media, join the discord, or contact us for inquires. 
            We look forward to hearing from you! #TheSkysTheLimit</p>
        </div>           
    </section>

    <div class="new-section"></div>

    <!-- section 2 - how to join-->
    <section class="textbox">
        <h2>How to Join</h2>

        <div>
            <p>Lorem Ipsum Sis simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
        </div>           
    </section>

    <div class="new-section"></div>
    
    <!-- section 3 - watch our games-->
    <section class="textbox">
        <h2>Watch our Games!</h2>

        <div>
            <p>We Frequently cast our team's matches on our <a href="https://www.twitch.tv/fallingskygg" target="_blank">Twitch channel.</a>. Check out our <a href="#schedule">schedule</a> for upcoming games!</a></p>
        </div>  
        <video width="920" height="auto" controls>
            <source src="video\twitch_clip.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>      
    </section>

    <div class="new-section"></div>

    <!-- section 2 - decal-->
    <section class="textbox">
        <h2>Our Rocket League Decal</h2>
        <img src="img\decal.png" id="decal">
        <a href="file/Falling_Sky_Octane_Decal.zip" download="Falling_Sky_Octane_Decal.zip">Download</a>
    </section>

    <div class="new-section"></div>

    <!-- section 3 - schedule -->
    <section class="table" id="schedule">
        <h2 class="container text-center">IGL Games this Week</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Match</th>
                        <th>Mode</th>
                        <th>Tier</th>
                        <th>Time</th>
                        <th>Stream</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
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
                                                            <td><a href="igl-team-details.php?iglTeamId='. $team['iglTeamId'] . '">' . $team['teamName'] . '</a> VS ' . $game['opponent'] . '</td>
                                                            <td>' . $team['mode'] . '</td>
                                                            <td>' . $team['tier'] . '</td>';

                                                            if (!empty($game['time']))
                                                            {
                                                                echo '<td>' . $game['time'] .' </td>';
                                                            }
                                                            else
                                                            {
                                                                echo '<td>TBD</td>';
                                                            }

                                                            if (!empty($game['stream']))
                                                            {
                                                                echo '<td>
                                                                    <a href="' . $game['stream'] . '" id="stream link" target="_blank">Link</a>
                                                                </td>';
                                                            }
                                                            else
                                                            {
                                                                echo '<td>N/A</td>';
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
        </div>
    </section>
</body>
<?php
    require 'includes/footer.php';
?>
</html>