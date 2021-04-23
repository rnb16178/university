<?php
session_start();
include 'classes/Database.php';
include 'classes/User.php';
include 'classes/About.php';
$Db = new Db();
$about = new About();
$user = new User();

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
        .page-content {
            padding: 10px;
        }

        .page-content h1 {
            text-align: center;
            padding: 10px;
        }

        .page-content h2 {
            text-align: center;
        }

        .page-content h3 {
            text-align: center;
        }

        .box {
            width: 100%;
            position: relative;
            display: inline-block;
        }

        .box img {
            width: 100%;
        }

        .box .text {
            position: absolute;
            z-index: 999;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: 4%;
            text-align: center;
            width: 100%;
        }

        .member-div {
            display: inline-block;
            text-align: center;
            width: 100%;

        }

        .member-div img {
            width: 100%;
        }

        .member {
            width: 300px;
            margin: 10px;
            display: inline-block;
            vertical-align: top;
        }

        .member-container {
            display: inline-block;
            text-align: center;
            width: 100%;
        }

        .footer {
            width: 100%;
            background-color: black;
            padding: 10px;
            text-align: center;
        }

        .fa {
            font-size: 30px;
            width: 50px;
            text-align: center;
            text-decoration: none;
            color: white;
        }

        /* Add a hover effect if you want */
        .fa:hover {
            opacity: 0.7;
        }

        .header-bar {
            background-color: black;
            color: white;
        }

        biography textarea {
            width: 100%;
        }

        .member-form {

            border-radius: 5px;
            background-color: black;
            padding: 20px;
            width: 50%;
        }
        .member-form p{
            color: white;
        }

        .nav-menu {
            display: grid;
            grid-template-columns: repeat(6, auto);
            list-style: none;
            text-align: center;
            width: 80%;
            justify-self: end;
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
        <h1><b>About Us</b>
                <?php
                if ($_SESSION['logged-in']) {
                    echo '<a class="edit-button" href="./about.php">View</a>';
                }
                ?>
            </h1>
        </div>
  <?php
  $about->displayEditAbout();
  ?>
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