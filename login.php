<!-- get header -->
<?php
    $title = 'Login';
    require 'includes/header.php';
?>
<section class="login">
    <main class="container">
        <h1>Login</h1>
        <!-- This php code is for if the user is incorrect in entering info -->
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
        <form method="post" action="account-validate.php">
            <!-- username -->
            <fieldset class="m-1">
                <label for="name" class="col-2">Username:</label>
                <input name="name" id="name" />
            </fieldset>

            <!-- password -->
            <fieldset class="m-1">
                <label for="password" class="col-2">Password:</label>
                <input type="password" name="password" id="password" required />
            </fieldset>

            <!-- login button -->
            <div class="offset-2">
                <button>Login</button>
            </div>
        </form>
    </main>
</section>
</body>
<?php
    require 'includes/footer.php';
?>
</html>