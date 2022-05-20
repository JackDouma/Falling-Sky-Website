<!-- get header -->
<?php
    $title = 'Admin Create';
    require 'includes/header.php';

    // make sure user is logged in
    if(empty($_SESSION['adminName']))
    {
        header('location:admin-login.php');
    }
?>

<main class="container">
    <h1>Admin Create</h1>

    <h6 class="alert alert-secondary" id="message">Password must be a minimum of 8 characters.</h6>

    <form method="post" action="save-admin.php">

        <!-- username -->
        <fieldset class="m-1">
            <label for="adminName" class="col-2">Username:</label>
            <input name="adminName" id="adminName" />
        </fieldset>

        <!-- password -->
        <fieldset class="m-1">
            <label for="password" class="col-2">Password:</label>
            <input type="password" name="password" id="password" required pattern=".{8,}" /> 
        </fieldset>

        <!-- password confirm -->
        <fieldset class="m-1">
            <label for="confirm" class="col-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required pattern=".{8,}" />
        </fieldset>

        <!-- confirm button that also checks to make sure password and confirm is same -->
        <div class="offset-2">
            <button class="btn btn-primary" onclick="return checkPasswords()">Create</button>
        </div>

    </form>
</main>

</body>
<?php
    require 'includes/footer.php';
?>
</html>