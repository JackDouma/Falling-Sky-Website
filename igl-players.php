<!-- get header -->
<?php
    $title = 'IGL Player List';
    require 'includes/header.php';
    require 'includes/admin-auth.php';
?>

<section class="h2">
    <div>
        <h2>IGL Player List</h2>
    </div>
<section class="table">
    <div>
        <table>
            <thead>
                <tr>
                    <th>Player</th>
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
                        $sql = "SELECT * FROM iglPlayers";
                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $players = $cmd->fetchAll();

                        // loops through data and creates table
                        foreach ($players as $player)
                        {
                            echo 
                            '<tr>
                                <td>' . $player['name'] . '</td>

                                <td>
                                    <a href="add-igl-player.php?iglPlayerId=' . $player['iglPlayerId'] . '">
                                        Edit
                                    </a>
                                </td>

                                <td>
                                    <a href="delete-igl-player.php?iglPlayerId=' . $player['iglPlayerId'] . '" class="btn btn-danger"
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