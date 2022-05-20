<?php
    $title = 'Home';
    require 'includes/header.php';
?>
    <div class="navbar">
        <img id="navimg" src="C:\Users\raguinaga\OneDrive - University of Mary Hardin-Baylor\Personal Items\HTMLPractice\img\FSE1.png">
        <a class="left-links" href="home.html"><b>HOME</b></a>
        <a class="left-links" href="staff.html"><b>STAFF</b></a>
        <a class="left-links" href="teams.html"><b>TEAMS</b></a>
        <a class="left-links" href="#"><b>MERCH</b></a>
        <a class="left-links" href="#"><b>CONTACT</b></a>
        <a class="left-links" href="fseabout.html"><b>ABOUT</b></a>

        
        <a class="fab fa-tiktok" id="social-icons" href="https://www.tiktok.com/@fallingskyesports"></a>
        <a class="fab fa-twitter" id="social-icons" href="https://twitter.com/FallingSkyGG"></a>
        <a class="fab fa-discord" id="social-icons" href="#"></a>
        <a class="fab fa-twitch" id="social-icons" href="https://www.twitch.tv/fallingskygg"></a>
        <a class="fab fa-youtube" id="social-icons" href="https://www.youtube.com/channel/UCkFMUKrHhFiYktGMGk9pHqg"></a>
    </div>

    <div class="contact-section">
        <h1>CONTACT US</h1>
        <form class="about-form">
            <label>Name:</label>
            <input type="text">
            <label>Email:</label>
            <input type="email">
            <label>Comment:</label>
            <input type="textarea">
        </form>
    </div>
</body>
<?php
    require 'includes/footer.php';
?>
</html>