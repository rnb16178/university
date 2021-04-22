<?php
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();
session_start();
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
        ul {
            list-style-type: none;
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
            <h1><b>Discography</b>
                <?php
                if ($_SESSION['logged-in']) {
                    echo '<a class="edit-button" href="./editdiscography.php">Edit</a>';
                }
                ?>
            </h1>
        </div>
        <?php
        $Db->connect();
        $sql = "SELECT * FROM discography WHERE type = 'album'";
        $result = $Db->select($sql);
        if ($result->num_rows > 0) {
            echo "<div class=album-container><h1>Albums</h1>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='album'>";
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<br><img width= 300px src='uploads/".$row['imagename']."'/><br>";

                echo "<br><h3>About</h3>" . $row["about"];
                echo "<br><hr><br><h3>Tracks</h3>";
                $sql = "SELECT * FROM tracks WHERE album = '" . $row["name"] . "'";
                $result2 = $Db->select($sql);
                if ($result2) {
                    if ($result2->num_rows > 0) {
                        echo "<ul>";
                        while ($row2 = $result2->fetch_assoc()) {
                            echo "
                        <li>" . $row2["title"] . "</li>";
                        }
                        echo "</ul>";
                    }
                }
        ?>
             
        <?php
                echo "</div>";
            }
            echo '</div><br>';
        }
        $sql = "SELECT * FROM discography WHERE type = 'single'";
        $result = $Db->select($sql);
        if ($result->num_rows > 0) {
            echo "<div class=album-container><h1>Singles</h1>";

            while ($row = $result->fetch_assoc()) {
                echo "<div class='album'>";
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<br><img width= 300px src='uploads/".$row['imagename']."'/><br>";
                echo $row["about"];
                echo "<p> " . $row["tracks"], "</p>";
                echo "</div>";
            }
            echo "</div>";
        }
        $Db->disconnect();

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