<?php
session_start();
include 'classes/Database.php';
include 'classes/User.php';
include 'classes/Gallery.php';
$Db = new Db();
$gallery = new Gallery();
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
            <h1><b>Gallery</b>
                <?php
                if ($_SESSION['logged-in']) {
                    echo '<a class="edit-button" href="./Galleryedit.php">Edit</a>';
                }
                ?>
            </h1>
        </div>

        <?php
        $gallery->displayGallery();
        ?>
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