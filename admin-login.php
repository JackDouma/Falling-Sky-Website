<!-- get header -->
<?php
    $title = 'Admin Login';
    require 'includes/header.php';
?>

<main class="container">
    <h1>Admin Login</h1>
    <!-- This php code is for if the user is incorrect in entering admin info -->
    <?php
        if (empty($_GET['invalid']))
        {
            echo '<h6 class="alert alert-secondary">Please enter your credentials.</h6>';
        }
        else
        {
            echo '<h6 class="alert alert-info">Invalid Login.</h6>';
        }
    ?>
    <form method="post" action="admin-validate.php">
        <!-- username -->
        <fieldset class="m-1">
            <label for="adminName" class="col-2">Username:</label>
            <input name="adminName" id="adminName" />
        </fieldset>

        <!-- password -->
        <fieldset class="m-1">
            <label for="password" class="col-2">Password:</label>
            <input type="password" name="password" id="password" required />
        </fieldset>

        <!-- login button -->
        <div class="offset-2">
            <button class="btn btn-primary">Login</button>
        </div>
    </form>
</main>
</body>
</html>