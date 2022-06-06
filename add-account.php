<!-- get header -->
<?php
    $title = 'Account Create';
    require 'includes/header.php';

    // make sure user is logged in
    require 'includes/admin-auth.php';
?>

<main class="container">
    <h1>Account Create</h1>

    <h6 class="alert alert-secondary" id="message">Password must be a minimum of 8 characters.</h6>

    <form method="post" action="save-account.php">

        <!-- username -->
        <fieldset class="m-1">
            <label for="name" class="col-2">Username:</label>
            <input name="name" id="name" />
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

        <fieldset class="m-1">
            <label for="type" class="col-2">Type:</label>
            <select id="type" name="type" id="type">
                <option value="1">Admin</option>
                <option value="2">Captain</option>
            </select>
        </fieldset>

        <!-- confirm button that also checks to make sure password and confirm is same -->
        <div class="offset-2">
            <button onclick="return checkPasswords()">Create</button>
        </div>

    </form>
</main>

</body>
<?php
    require 'includes/footer.php';
?>
</html>