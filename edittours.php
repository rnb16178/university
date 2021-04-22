<?php
session_start();
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();
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
            <h1><b>Tours</b>
                <?php
                if ($_SESSION['logged-in']) {
                    echo '<a class="edit-button" href="./tours.php">View</a>';
                }

                ?>
            </h1>
        </div>
        <br>
        <?php
        if($_SESSION['logged-in']){
        $Db->connect();
        $sql = "SELECT * FROM tours";
        $result = $Db->select($sql);
        if ($result->num_rows > 0) {
            echo '<div class="tour"><table><tr>
         <th><h2>Date</h2></th>
         <th>Venue</th>
         <th>City</th>
         </tr>';
            while ($row = $result->fetch_assoc()) {
                echo "<tr><form method='post' action='updateTours.php'>";
                list($year, $month, $day) = explode('-', $row['date']);
                if ($month == 1) {
                    $month = "Jan";
                } else if ($month == 2) {
                    $month = "Feb";
                } else if ($month == 3) {
                    $month = "Mar";
                } else if ($month == 4) {
                    $month = "Apr";
                } else if ($month == 5) {
                    $month = "May";
                } else if ($month == 6) {
                    $month = "June";
                } else if ($month == 7) {
                    $month = "Jul";
                } else if ($month == 8) {
                    $month = "Aug";
                } else if ($month == 9) {
                    $month = "Sep";
                } else if ($month == 10) {
                    $month = "Oct";
                } else if ($month == 11) {
                    $month = "Nov";
                } else if ($month == 12) {
                    $month = "Dec";
                }
                echo'<input type=hidden name="id" value='.$row["id"].'>';
                echo "<td>" ."<input type='date' name='date' value='".$row["date"] . "'></td>";
                echo "<td>" ."<input type='text' name='venue' value='".$row["venue"] . "'></td>";
                echo "<td>" ."<input type='text' name='country' value='".$row["country"] . "'></td>";
                echo "<td><input type='submit' name='action' value='Update' >" .  "</td>";
                echo "<td><input type='submit' name='action' value='Delete' >" .  "</td>";

                echo "</form></tr></div>";
            }
            echo "</table>";
            ?>
            <h2>Add New Tour</h2>
            <form action="updateTours.php" method="post">
                <input type="hidden" name="add" value="selected">
            <input type="date" name="date">
            <input type="text" name="venue" placeholder="Venue">
            <input type="text" name="city" placeholder="city">
            <input type='submit' name='action' value='Add' >
            </form>
            <?php
        } else {
            echo "<p>There currently arent any tours planned</p>";
        }
        ?>

    </div>
    <?php
        }else{
            header("Location: tours.php");
        }

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