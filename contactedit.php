<?php
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();
session_start();
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
                <li><a href="./contact.php" class="nav-links">Contact</a></li>

            </ul>
        </div>
    </div>
    <div class="page-content">
        <div class="header-bar">
            <h1><b>Contact Us</b>
                <?php
                if ($_SESSION['logged-in']) {
                    echo '<a class="edit-button" href="./contact.php">View</a>';
                }

                ?>
            </h1>
        </div>
        <?php
        if ($_SESSION['logged-in']) {
            $servername = "localhost";
            $database = 'monster-truck';
            $username = 'root';
            $password = '';
            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("<p>Connection failed!</p></body></html>");
            }
            $sql = "SELECT * FROM `contact-form`";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<table>"
                    . "<tr>"
                    . "\t\t\t\t<th>ID</th>\n"
                    . "\t\t\t\t<th>Name</th>\n"
                    . "\t\t\t\t<th>Email</th>\n"
                    . "\t\t\t\t<th>Message</th>\n"
                    . "\t\t\t\t<th>&nbsp;</th>\n"
                    . "\t\t\t\t<th>&nbsp;</th>\n"
                    . "\t\t\t</tr>\n";
                while ($row = $result->fetch_assoc()) {
                    echo "\t\t\t<tr>\n"
                        . "\t\t\t\t<td>" . $row["id"] . "</td>\n"
                        . "\t\t\t\t<td>" . $row["name"] . "</td>\n"
                        . "\t\t\t\t<td>" . $row["email"] . "</td>\n"
                        . "\t\t\t\t<td>" . $row["message"] . "</td>\n"
                        . "\t\t\t\t<td><a href=\"deleterecord.php?id=" . $row["id"] . "\">Delete</a></td>\n"
                        . "\t\t\t</tr>\n";
                }
                echo "\t\t</table>\n";
            } else {
                echo "<p>No results returned!</p>\n";
            }

            $conn->close();
        ?>
    </div>

    </div>
<?php
        } else {
            header("location: contact.php");
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