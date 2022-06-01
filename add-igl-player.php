<!-- get header -->
<?php
    $title = 'IGL Player Create';
    require 'includes/header.php';

    // make sure user is logged in
    if(empty($_SESSION['adminName']))
    {
        header('location:admin-login.php');
    }
?>

<main class="container">
    <h1>IGL Player Create</h1>

    <form method="post" action="save-igl-player.php">

        <!-- name -->
        <fieldset class="m-1">
            <label for="name" class="col-2">Name:</label>
            <input name="name" id="name" required maxlength="20" />
        </fieldset>

        <!-- bio -->
        <fieldset class="m-1">
            <label for="bio" class="col-2">Bio (optional):</label>
            <input name="bio" id="bio" required maxlength="100" />
        </fieldset>

        <!-- tier -->
        <fieldset class="m-1">
            <label for="tier" class="col-2">Tier:</label>
            <select name="tier" id="tier">
            <option value="1" selected>1</option>
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
            <button>Create</button>
        </div>
    </form>
</main>

</body>
<?php
    require 'includes/footer.php';
?>
</html>