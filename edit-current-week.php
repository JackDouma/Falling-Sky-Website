<?php
    $title = 'Edit Current Week';
    require 'includes/header.php';
    require 'includes/admin-auth.php';

    try
    {
        $weekId = null;
        $seasonId = null;
        $week = null;
        
        if (isset($_GET['weekId'])) 
        {
            if (is_numeric($_GET['weekId'])) 
            {
                $weekId = $_GET['weekId'];

                // connect sql
                require 'includes/db.php';

                // run sql command and get webpage details
                $sql = "SELECT * FROM currentWeek WHERE weekId = :weekId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':weekId', $weekId, PDO::PARAM_INT);
                $cmd->execute();
                $currentWeek = $cmd->fetch(); 

                // if player found, get values
                if (!empty($currentWeek))
                {
                    $weekId = $currentWeek['weekId'];
                    $seasonId = $currentWeek['seasonId'];
                    $week = $currentWeek['week'];
                    $db = null;
                }
                // if not found
                else
                {
                    $db = null;
                    header('location:error.php');
                    exit();
                }
            }
        }
    }
    // if site is unable to load
    catch (Exception $error)
    {
        header('location:error.php');
    }
?>

<main class="container">
    <h1>Edit Current Week</h1>

    <form method="post" action="save-current-week.php">

        <!-- season -->
        <fieldset class="m-1">
            <label for="seasonId" class="col-2">Season:</label>
            <select name="seasonId" id="seasonId">
                <option value=""></option>
                <?php
                    try 
                    {
                        // this php code will get and show all seasons that have been created
                        require 'includes/db.php';

                        $sql = "SELECT * FROM seasons";

                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $seasons = $cmd->fetchAll();

                        foreach ($seasons as $season) 
                        {          
                            if ($seasonId == $season['seasonId'])
                            {
                                echo '<option selected value="' . $season['seasonId'] . '">' . $season['seasonName'] . '</option>';    
                            }   
                            else
                            {
                                echo '<option value="' . $season['seasonId'] . '">' . $season['seasonName'] . '</option>';    
                            }                                                                    
                        }

                        $db = null;
                    }
                    catch (Exception $error) 
                    {
                        header('location:error.php');
                    }
                ?>
            </select>
        </fieldset>

        <!-- week -->
        <fieldset class="m-1">
            <label for="week" class="col-2">Week:</label>
            <select name="week" id="week" required>
            <option value="<?php echo $week; ?>"><?php echo $week; ?></option>
            <option value="-1">Off Season</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            </select>
        </fieldset>

        <!-- submit button -->
        <div class="offset-2">
            <input type="hidden" name="weekId" id="weekId" value="<?php echo $weekId; ?>" />
            <button>Save</button>
        </div>
    </form>
</main>

</body>
<?php
    require 'includes/footer.php';
?>
</html>