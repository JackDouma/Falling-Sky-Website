<?php
    $title = 'Delete IGL Game';
    require 'includes/header.php';
    require 'includes/captain-auth.php';

    try
    {
        // validate primary key
        if (isset($_GET['scheduleId']))
        {
            if (is_numeric($_GET['scheduleId']))
            {
                // connect sql
                require 'includes/db.php';

                // sql delete command
                $sql = "DELETE FROM iglSchedule WHERE scheduleId = :scheduleId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':scheduleId', $_GET['scheduleId'], PDO::PARAM_INT);
                $cmd->execute();
               
                $db = null;

                // show result
                echo '<div class="alert alert-info">Game deleted.  
                        <a href="index.php">Return Home</a>
                    </div>';
                }
            else
            {
                echo '<div class="alert alert-warning">Game Missing</div>';
            }
        }
        else
        {
            echo '<div class="alert alert-warning">Game Missing</div>';
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