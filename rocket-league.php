<?php
    $title = 'RL Home';
    require 'includes/header.php';
?>

    <!-- masthead -->
    <section class="rh-masthead">
        <div>
            
        </div>
    </section>

    <!-- section 1 - main roster -->
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
    </section>


    <!-- section 2 - IGL -->
    <section class="rh-h2-2">
        <h2>IGL Teams</h2>
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
</body>
<?php
    require 'includes/footer.php';
?>
</html>