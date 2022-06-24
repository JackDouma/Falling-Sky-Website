<?php
    $title = 'Delete Application';
    require 'includes/header.php';
    require 'includes/admin-auth.php';

    try
    {
        // validate primary key
        if (isset($_GET['appId']))
        {
            if (is_numeric($_GET['appId']))
            {
                // connect sql
                require 'includes/db.php';

                // sql delete command
                $sql = "DELETE FROM applications WHERE appId = :appId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':appId', $_GET['appId'], PDO::PARAM_INT);
                $cmd->execute();
               
                $db = null;

                // show result
                header('location:apps.php');
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