<!-- get header -->
<?php
    $title = 'IGL Team List';
    require 'includes/header.php';
    require 'includes/admin-auth.php';
?>

<section class="h2">
    <div>
        <h2>IGL Team List</h2>
    </div>
<section class="table">
<div>
    <table>
        <thead>
            <tr>
                <th>Team</th>
                <th>Season</th>
                <th>Gamemode</th>
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
                    $sql = "SELECT iglTeams.*, seasons.seasonName as 'seasonName' 
                    FROM iglTeams 
                    INNER JOIN seasons 
                    ON iglTeams.seasonId = seasons.seasonId";
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $teams = $cmd->fetchAll();

                    // loops through data and creates table
                    foreach ($teams as $team)
                    {
                        echo 
                        '<tr>
                            <td>' . $team['teamName'] . '</td>
                            <td>' . $team['seasonName'] . '</td>
                            <td>' . $team['mode'] . '</td>

                            <td>
                                <a href="add-igl-team.php?iglTeamId=' . $team['iglTeamId'] . '">
                                    Edit
                                </a>
                            </td>

                            <td>
                                <a href="delete-igl-team.php?iglTeamId=' . $team['iglTeamId'] . '" class="btn btn-danger"
                                    onclick="return confirmDelete()">
                                    Delete
                                </a>
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