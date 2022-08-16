<!-- get header -->
<?php
    $title = 'IGL Game List';
    require 'includes/header.php';
    require 'includes/admin-auth.php';
?>

<section class="h2">
    <div>
        <h2>IGL Game List</h2>
    </div>
<section class="table">
    <div>
        <table>
            <thead>
                <tr>
                    <th>Match</th>
                    <th>Season</th>
                    <th>Week</th>
                    <th>Gamemode</th>
                    <th>Tier</th>
                    <th>Stream</th>
                    <th>Result</th>
                    <th>Edit</th>
                    <th>Delete</th>
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

                        // loops through data and creates table
                        foreach (array_reverse($seasons) as $season)
                        {   
                            foreach (array_reverse($teams) as $team)
                            {     
                                // if season == team season is playing in
                                if ($team['seasonId'] == $season['seasonId'])
                                {     
                                    foreach (array_reverse($games) as $game)
                                    {                                
                                        // if team == team with a match
                                        if ($team['iglTeamId'] == $game['iglTeamId'])
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

                                                echo '<td>
                                                    <a href="add-igl-game.php?scheduleId=' . $game['scheduleId'] . '">
                                                        Edit
                                                    </a>
                                                </td>

                                                <td>
                                                    <a href="delete-igl-game.php?scheduleId=' . $game['scheduleId'] . '" class="btn btn-danger"
                                                        onclick="return confirmDelete()">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>';
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