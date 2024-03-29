<?php
    $title = 'Season';
    require 'includes/header.php';
?>
<section class="h2">
    <div>
        <h2>Teams</h2>
    </div>
<?php
    try
    {
        if (isset($_GET['seasonId'])) 
        {
            if (is_numeric($_GET['seasonId'])) 
            {
                $seasonId = $_GET['seasonId'];

                $param = true;         
            }
        }

        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        // if there is a param, show IGL teams that played that season
        if ($param)
        {         
            // connect sql
            require 'includes/db.php';

            // run sql command and get teams
            $sql = "SELECT * FROM iglTeams WHERE seasonId = $seasonId";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $teams = $cmd->fetchAll();

            

            echo '<section class="table">';
                echo '<div>';
                    echo '<table>';
                        echo '<thead>';
                            echo '<tr>';
                                echo '<th>Team</th>';
                                echo '<th>Mode</th>';
                                echo '<th>Tier</th>';
                                echo '<th>Team Page</th>';
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';                                                               

                            // loops through data and creates table
                            foreach ($teams as $team)
                            {
                                echo 
                                '<tr>
                                    <td>' . $team['teamName'] . '</td>
                                    <td>' . $team['mode'] . '</td>
                                    <td>' . $team['tier'] . '</td>

                                    <td>
                                        <a href="igl-team-details.php?iglTeamId=' . $team['iglTeamId'] . '">
                                            View
                                        </a>
                                    </td>
                                </tr>';
                            }

                            $db = null;
                            
                        echo '</tbody>';
                    echo '</table>';
                echo '</div>';      
            echo '</section>';
        }
    }
    catch (Exception $error)
    {
        header('location:error.php');
    }
?>

</body>
<?php
    require 'includes/footer.php';
?>
</html>