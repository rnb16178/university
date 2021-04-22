<?php
session_start();
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();
if (!isset($_SESSION['logged-in'])) {
    $_SESSION['logged-in'] = false;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>MonsterTruck</title>
    <style>
        /* Style all font awesome icons */
        .contact-container {
            display: inline-block;
            text-align: center;
            width: 100%;
        }

        .form {
            width: 400px;
            margin: 10px;
            display: inline-block;
            vertical-align: top;
            border-radius: 4px;
  background-color: black;
  padding: 20px;
            
        }

        .SM-links {
            width: 200px;
            margin: 10px;
            display: inline-block;
            vertical-align: top;
            color: black;
        }
    </style>
</head>

<body>
    <div class="nav-container">
        <div class="navbar">
            <a href="./index.php"><img id="navbar-logo" src="./images/logo.png" alt="Logo" style="height: 70px;"></a>
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav-menu">
                <li><a href="./about.php" class="nav-links">About</a></li>
                <li><a href="./discography.php" class="nav-links">Discography</a></li>
                <li><a href="./music.php" class="nav-links">Music</a></li>
                <li><a href="./tours.php" class="nav-links">Tours</a></li>
                <li><a href="./gallery.php" class="nav-links">Gallery</a></li>
                <li><a href="./contact.php" class="nav-links">Contact</a></li>
            </ul>
        </div>
    </div>
    <div class="page-content">
        <div class="header-bar">
            <h1><b>Contact Us</b>
                <?php
                if ($_SESSION['logged-in']) {
                    echo '<a class="edit-button" href="./contactedit.php">Edit</a>';
                }

                ?>
            </h1>
        </div>

        <div class="page-content">
            <div class="contact-container">


                <div class="form">
                    <form action="contactsubmit.php" method="post">
                        <input type="text" placeholder="Your name" name="name"><br>
                        <input type="email" placeholder="Your Email" name="email"><br>
                        <textarea id="message" name="message" rows="4" cols="50" placeholder="Your Message"></textarea>
                        <input type="submit" value="Send">
                    </form>
                </div>

                <div class="SM-links">
                    <h2>Find us on Social media</h2>
                    <a href="https://www.facebook.com/ilovemonstertruck" class="fa fa-facebook"></a>
                    <a href="https://twitter.com/Monster_Truck_" class="fa fa-twitter"></a>
                    <a href="https://www.instagram.com/ilovemonstertruck/" class="fa fa-instagram"></a>
                    <a href="https://soundcloud.com/ilovemonstertruck" class="fa fa-soundcloud"></a>
                    <a href="https://open.spotify.com/artist/0slSgjqTuj6hcod6IcG6zu" class="fa fa-spotify"></a>
                    <a href="https://music.apple.com/ca/artist/monster-truck/466061729" class="fa fa-apple"></a>
                    <a href="https://music.apple.com/ca/artist/monster-truck/466061729" class="fa fa-youtube"></a>

                </div>
            </div>

        </div>

        <script>
            const menu = document.querySelector('#mobile-menu');
            const menuLinks = document.querySelector('.nav-menu');
            menu.addEventListener('click', function() {
                menu.classList.toggle('is-active');
                menuLinks.classList.toggle('active');
            })
        </script>
</body>

</html>