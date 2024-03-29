<!-- get header -->
<?php
    $title = 'Applications';
    require 'includes/header.php';
    require 'includes/admin-auth.php';
?>

<section class="h2">
    <div>
        <h2>Application List</h2>
    </div>

<section class="table">
    <div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Position</th>
                    <th>Experience</th>
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
                        $sql = "SELECT * FROM applications";
                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $apps = $cmd->fetchAll();

                        // loops through data and creates table
                        foreach ($apps as $app)
                        {                   
                            echo 
                            '<tr>
                                <td>' . $app['name'] . '</td>
                                <td>' . $app['contact'] . '</td>
                                <td>' . $app['position'] . '</td>
                                <td>' . $app['experience'] . '</td>

                                <td>
                                    <a href="delete-app.php?appId=' . $app['appId'] . '" class="btn btn-danger">
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