<?php
    try
    {
        // get header
        $title = 'Saving Application...';
        require 'includes/header.php';

        // get form inputs
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $position = $_POST['position'];
        $experience = $_POST['experience'];
        $ok = true;


        // make sure some inputs are not empty
        if (empty($name)) 
        {
            echo '<p class="alert alert-info">Name is required.</p>';
            $ok = false;
        }
        
        if (empty($contact)) 
        {
            echo '<p class="alert alert-info">Contact is required.</p>';
            $ok = false;
        }

        if (empty($position)) 
        {
            echo '<p class="alert alert-info">Position is required.</p>';
            $ok = false;
        }


        // if all pass
        if ($ok)
        {
            // connect sql
            require 'includes/db.php';
            
            // save new app
            $sql = "INSERT INTO applications (name, contact, position, experience) VALUES (:name, :contact, :position, :experience)";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':name', $name, PDO::PARAM_STR, 50);
            $cmd->bindParam(':contact', $contact, PDO::PARAM_STR, 50);
            $cmd->bindParam(':position', $position, PDO::PARAM_STR, 50);
            $cmd->bindParam(':experience', $experience, PDO::PARAM_STR, 100);
            $cmd->execute();

            // disconnect from sql
            $db = null;

            echo '<div class="alert alert-info">Application Submitted.  
                <a href="index.php">To Home</a>
            </div>';
        }          
    } 
    catch (Exception $error)
    {
        header('location:error.php');
    }
?>
</body>
</html>