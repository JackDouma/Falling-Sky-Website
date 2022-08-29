<?php
    $title = 'Staff';
    require 'includes/header.php';
?>
<!-- masthead -->
<section class="masthead">
    <div>
        <h1>STAFF</h1>
    </div>
</section>

<div class="new-section"></div>

<!-- our staff -->
<section class="h2">
    <div>
        <h2>Meet The Staff</h2>
    </div>

<section class="s-row-one">
    <div>
        <h3>Ren</h3>
        <h5>Owner</h5>
        <img src="img\ren.png" id="ren">
        <a href="https://twitter.com/FSE_Ren" target="_blank"><img src="img\twitter.png" id="ren_twitter"></a>
    </div>
    <div>
        <h3>Ares</h3>
        <h5>Owner</h5>
        <img src="img\ares.png" id="ares">
        <a href="https://twitter.com/aid_blossom" target="_blank"><img src="img\twitter.png" id="ares_twitter"></a>
    </div> 
    <div>
        <h3>Fion3il</h3>
        <h5>Admin</h5>
        <img src="img\fion3il.jpg" id="fion3il">
        <a href="https://twitter.com/fion3il" target="_blank"><img src="img\twitter.png" id="fion3il_twitter"></a>
    </div>  
    <div>
        <h3>Zenith</h3>
        <h5>RL Manager</h5>
        <img src="img\zenith.jpg" id="fion3il">
        <a href="https://twitter.com/zenith6000x" target="_blank"><img src="img\twitter.png" id="zenith_twitter"></a>
    </div> 
    <div>
        <h3>JackeyBoy</h3>
        <h5>Website Dev</h5>
        <img src="img\jackeyboy.png" id="jackeyboy">
        <a href="https://twitter.com/JackeyB0y" target="_blank"><img src="img\twitter.png" id="jackeyboy_twitter"></a>
    </div>
    <div>
        <h3>Hakuu</h3>
        <h5>Social Media</h5>
        <img src="img\hakuu.jpg" id="hakuu">
        <a href="https://twitter.com/HakuuMF" target="_blank"><img src="img\twitter.png" id="twitter"></a>
    </div>               
</section>

<div class="new-section"></div>

<!-- join the staff -->
<section class="textbox">
    <h2>Join The Staff</h2>
    <div>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
    </div>
</section>

<!-- apply -->
<section class="h2">
    <div>
        <h2>Apply</h2>
    </div>
</section>

<section class="s-row-three">
    <div>
        <h3>Available Positions</h3>
        <h6>Temp1</h6>
        <h6>Temp2</h6>
        <h6>Temp3</h6>
    </div>

    <div>
        <form method="post" action="save-app.php">
            <!-- name -->
            <fieldset class="m-1">
                <label for="name" class="col-3">Name:</label>
                <input name="name" id="name"/>
            </fieldset>
            <!-- email -->
            <fieldset class="m-1">
                <label for="contact" class="col-3">Contact:</label>
                <input name="contact" id="contact" placeholder="Email, Discord, etc" />
            </fieldset>

            <!-- job/subject -->
            <fieldset class="m-1">
                <label for="position" class="col-3">Position:</label>
                <select id="position" name="position">
                    <option value="temp1">temp1</option>
                    <option value="temp2">temp2</option>
                    <option value="temp3">temp3</option>
                </select>
            </fieldset>

            <fieldset class="m-1">
                <label for="experience" class="col-3">Experience:</label>
                <input name="experience" id="experience"  placeholder="Optional">
            </fieldset>
        

            <!-- confirm button that also checks to make sure password and confirm is same -->
            <div class="offset-2">
                <button>Send</button>
            </div>
        </form>
    </div>
</section>
</body>
<?php
    require 'includes/footer.php';
?>
</html>