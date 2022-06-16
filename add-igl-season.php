<!-- get header -->
<?php
    $title = 'Create IGL Season';
    require 'includes/header.php';
    require 'includes/admin-auth.php';
?>

<main class="container">
    <h1>Create IGL Season</h1>

    <div class="alert alert-danger"> --> WARNING! This cannot be undone. <--</div>

    <form method="post" action="save-igl-season.php">

        <!-- name -->
        <fieldset class="m-1">
            <label for="seasonName" class="col-2">Season Name:</label>
            <input name="seasonName" id="seasonName" required maxlength="20" />
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