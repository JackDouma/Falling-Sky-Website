<?php
    $title = 'Staff';
    require 'includes/header.php';
?>
<section class="s-masthead">
    <h1>image header here</h1>
</section>

<!-- our staff -->
<section class="s-h2-1">
    <h2>Meet The Staff</h2>
</section>
<section class="s-row-one">
    <div>
        <h3>Ren</h3>
        <h5>Owner</h5>
        <img src="img\logo.png" id="temp">
    </div>
    <div>
        <h3>Ares</h3>
        <h5>Owner</h5>
        <img src="img\logo.png" id="temp">
    </div> 
    <div>
        <h3>Nate</h3>
        <h5>Admin</h5>
        <img src="img\logo.png" id="temp">
    </div>  
    <div>
        <h3>Noxxi</h3>
        <h5>Admin</h5>
        <img src="img\logo.png" id="temp">
    </div>  
    <div>
        <h3>Zenith</h3>
        <h5>Dev & RL Manager</h5>
        <img src="img\logo.png" id="temp">
    </div> 
    <div>
        <h3>JackeyBoy</h3>
        <h5>Dev</h5>
        <img src="img\jackeyboy.jpg" id="jackeyboy">
    </div>
    <div>
        <h3>Hakuu</h3>
        <h5>Social Media</h5>
        <img src="img\logo.png" id="temp">
    </div>               
</section>

<!-- join the staff -->
<section class="s-h2-2">
    <h2>Join The Staff</h2>
</section>

<section class="s-row-two">
    <div>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
    </div>
</section>

<section class="s-row-three">
    <h3>Available Positions</h3>
    <div>
        <h6>Temp1</h6>
        <h6>Temp2</h6>
        <h6>Temp3</h6>
    </div>
</section>

<section class="s-row-four">
    <h3>Apply</h3>

    <form method="post" action="send-email.php">

        <!-- email -->
        <fieldset class="m-1">
            <label for="email" class="col-2">Email:</label>
            <input name="email" id="email" required type="email" placeholder="email@domain.com" />
        </fieldset>

        <!-- job/subject -->
        <fieldset class="m-1">
            <label for="position" class="col-2">Position:</label>
            <select id="position" name="position">
                <option value="temp1">temp1</option>
                <option value="temp2">temp2</option>
                <option value="temp3">temp3</option>
            </select>
        </fieldset>

        <fieldset class="m-1">
            <label for="file" class="col-2">Resume:</label>
            <input type="file" id="myfile" name="myfile">
        </fieldset>
    

        <!-- confirm button that also checks to make sure password and confirm is same -->
        <div class="offset-2">
            <button>Send</button>
        </div>
    </form>
</section>
</body>
<?php
    require 'includes/footer.php';
?>
</html>