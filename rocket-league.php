<?php
    $title = 'RL Home';
    require 'includes/header.php';
?>

    <!-- masthead -->
    <section class="rh-masthead">
        <div>
            <h1>RL Academy header here</h1>
        </div>
    </section>

    <!-- section 1 - main roster 
    <section class="rh-h2-1">
        <h2>Main Roster</h2>
    </section> 

    <section class="rh-row-one">
        <div>
            <h3>Temp</h3>
            <img src="img\logo.png" id="temp">
        </div>
        <div>
            <h3>Temp</h3>
            <img src="img\logo.png" id="temp">
        </div> 
        <div>
            <h3>Temp</h3>
            <img src="img\logo.png" id="temp">
        </div>                
    </section> -->


    <!-- section 2 - IGL -->
    <section class="rh-title">
        <h2>Indy Gaming League</h2>
        <div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
        </div>
    </section>

    <section class="rh-row-two">
        <div class="container text-center">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Season</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        try
                        {
                            // connect sql
                            require 'includes/db.php';

                            // get table
                            $sql = "SELECT * FROM seasons";
                            $cmd = $db->prepare($sql);
                            $cmd->execute();
                            $seasons = $cmd->fetchAll();

                            // loops through data and creates table
                            foreach ($seasons as $season)
                            {
                                echo 
                                '<tr>
                                    <td>
                                        <a href="igl-season.php?seasonId=' . $season['seasonId'] . '">' . $season['seasonName'] . '</a>
                                    </td>
                                </tr>';
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

    <!-- section 2 - IGL -->
    <section class="rh-title">
        <h2>BLCS</h2>
        <div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
        </div>
    </section>

    <section class="rh-row-three">
        <div class="container text-center">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Match</th>
                        <th>Description</th>
                        <th>Date & Time</th>
                        <th>Stream</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Falling Sky Esports VS Uncaged Gaming</td>
                        <td>Stage 1 Week 1</td>
                        <td>June 23rd, 9pm EST</td>
                        <td><a href="https://www.twitch.tv/thebrambo" id="stream link" target="_blank">TheBrambo</a></td>
                        <td>3-0 W</td>
                    </tr>
                    <tr>
                        <td>Falling Sky Esports VS MPG Homed Honeydews</td>
                        <td>Stage 1 Week 2</td>
                        <td>TBD</td>
                        <td>TBD</td>
                        <td>TBD</td>
                    </tr>
                    <tr>
                        <td>Falling Sky Esports VS Disconnect Purple</td>
                        <td>Stage 1 Week 3</td>
                        <td>TBD</td>
                        <td>TBD</td>
                        <td>TBD</td>
                    </tr>
                    <tr>
                        <td>Falling Sky Esports VS Inferno Esports</td>
                        <td>Stage 1 Week 4</td>
                        <td>TBD</td>
                        <td>TBD</td>
                        <td>TBD</td>
                    </tr>
                    <tr>
                        <td>Falling Sky Esports VS 999 Gaming</td>
                        <td>Stage 1 Week 5</td>
                        <td>TBD</td>
                        <td>TBD</td>
                        <td>TBD</td>
                    </tr>
                    <tr>
                        <td>Falling Sky Esports VS Unified Elite</td>
                        <td>Stage 1 Week 6</td>
                        <td>TBD</td>
                        <td>TBD</td>
                        <td>TBD</td>
                    </tr>
                    <tr>
                        <td>Falling Sky Esports VS 15 Bean Soup</td>
                        <td>Stage 1 Week 7</td>
                        <td>TBD</td>
                        <td>TBD</td>
                        <td>TBD</td>
                    </tr>
                </tbody>
            </table>
        </div>           
    </section>
</body>
<?php
    require 'includes/footer.php';
?>
</html>