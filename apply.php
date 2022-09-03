<?php
    $title = 'Apply';
    require 'includes/header.php';
?>
<!-- apply -->
<section class="h2">
    <div>
        <h2>Apply for Staff</h2>
    </div>


<section class="apply">
    <div>
        <form method="post" action="save-app.php">
            <!-- name -->
            <fieldset>
                <label for="name" class="col-2">Name:</label>
                <input name="name" id="name"/>
            </fieldset>
            <!-- email -->
            <fieldset>
                <label for="contact" class="col-2">Contact:</label>
                <input name="contact" id="contact" placeholder="Email, Discord, etc" />
            </fieldset>

            <!-- job/subject -->
            <fieldset>
                <label for="position" class="col-2">Position:</label>
                <select id="position" name="position">
                    <option value="temp1">temp1</option>
                    <option value="temp2">temp2</option>
                    <option value="temp3">temp3</option>
                </select>
            </fieldset>

            <fieldset>
                <label for="experience" class="col-2">Experience:</label>
                <input name="experience" id="experience"  placeholder="Optional">
            </fieldset>
        

            <!-- confirm button that also checks to make sure password and confirm is same -->
            <div>
                <button class="offset-2">Send</button>
            </div>
        </form>
    </div>
</section>
</body>
<?php
    require 'includes/footer.php';
?>
</html>