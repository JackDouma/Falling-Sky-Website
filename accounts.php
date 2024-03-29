<!-- get header -->
<?php
    $title = 'Accounts';
    require 'includes/header.php';
    require 'includes/admin-auth.php';
?>

<section class="h2">
    <div>
        <h2>Account List</h2>
    </div>
<section class="table">
    <div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
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
                        $sql = "SELECT * FROM accounts";
                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $accounts = $cmd->fetchAll();

                        // loops through data and creates table
                        foreach ($accounts as $account)
                        {
                            if ($account['type'] == 1)
                            {
                                $typeName = 'Admin';
                            }
                            else if ($account['type'] == 2)
                            {
                                $typeName = 'Captain';
                            }
                            
                            echo 
                            '<tr>
                                <td>' . $account['name'] . '</td>
                                <td>' .  $typeName . '</td>

                                <td>
                                    <a href="delete-account.php?accountId=' . $account['accountId'] . '" class="btn btn-danger"
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