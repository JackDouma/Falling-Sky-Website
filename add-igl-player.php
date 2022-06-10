<!-- get header -->
<?php
    $title = 'IGL Player Create';
    require 'includes/header.php';
    require 'includes/admin-auth.php';

    try
    {
        $iglPlayerId = null;
        $name = null;
        $bio = null;
        $tier = null;
        
        if (isset($_GET['iglPlayerId'])) 
        {
            if (is_numeric($_GET['iglPlayerId'])) 
            {
                $iglPlayerId = $_GET['iglPlayerId'];

                // connect sql
                require 'includes/db.php';

                // run sql command and get webpage details
                $sql = "SELECT * FROM iglPlayers WHERE iglPlayerId = :iglPlayerId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':iglPlayerId', $iglPlayerId, PDO::PARAM_INT);
                $cmd->execute();
                $player = $cmd->fetch(); 

                // if player found, get values
                if (!empty($player))
                {
                    $iglPlayerId = $player['iglPlayerId'];
                    $name = $player['name'];
                    $bio = $player['bio'];
                    $tier = $player['tier'];
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
    <h1>IGL Player Create</h1>

    <form method="post" action="save-igl-player.php">

        <!-- name -->
        <fieldset class="m-1">
            <label for="name" class="col-2">Name:</label>
            <input name="name" id="name" required maxlength="20" value="<?php echo $name; ?>"/>
        </fieldset>

        <!-- bio -->
        <fieldset class="m-1">
            <label for="bio" class="col-2">Bio (optional):</label>
            <input name="bio" id="bio" maxlength="100" value="<?php echo $bio; ?>" />
        </fieldset>

        <!-- tier -->
        <fieldset class="m-1">
            <label for="tier" class="col-2">Tier:</label>
            <select name="tier" id="tier" value="<?php echo $tier; ?>">
            <option value="<?php echo $tier; ?>"><?php echo $tier; ?></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            </select>
        </fieldset>

        <!-- submit button -->
        <div class="offset-2">
            <input type="hidden" name="iglPlayerId" id="iglPlayerId" value="<?php echo $iglPlayerId; ?>" />
            <button>Save</button>
        </div>
    </form>
</main>

</body>
<?php
    require 'includes/footer.php';
?>
</html>