<?php
    $title = 'Delete Account';
    require 'includes/header.php';
    require 'includes/admin-auth.php';

    try
    {
        // validate primary key
        if (isset($_GET['accountId']))
        {
            if (is_numeric($_GET['accountId']))
            {
                // connect sql
                require 'includes/db.php';

                // sql delete command
                $sql = "DELETE FROM accounts WHERE accountId = :accountId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':accountId', $_GET['accountId'], PDO::PARAM_INT);
                $cmd->execute();
               
                $db = null;

                // show result
                echo '<div class="alert alert-info">Account deleted.  
                        <a href="accounts.php">Return to Account List</a>
                    </div>';
                }
            else
            {
                echo '<div class="alert alert-warning">Account Missing</div>';
            }
        }
        else
        {
            echo '<div class="alert alert-warning">Account Missing</div>';
        }
    }
    // if site is unable to load
    catch (Exception $error)
    {
        header('location:error.php');
    }
?>
</body>
</html>