<?php
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();
if ($_POST['action'] == 'Add') {
    $venue = $_POST['venue'];
    $date = $_POST['date'];
    $city = $_POST['city'];
    $Db->connect();

    $sql = "INSERT INTO `tours` ( `date`, `venue`, `city`, `country`) VALUES ('$date', '$venue', '$city', 'country')";

    if ($Db->query($sql)) {
        header("Location: edittours.php");
        $Db->disconnect();
    } else {
        echo "<p>Error adding record!</p>\n\t</body>\n</html>";
    }
    $Db->disconnect();
} else if ($_POST['action'] == 'Update') {
    $Db->connect();

    $id= $_POST['id'];
    $venue = $_POST['venue'];
    $date = $_POST['date'];
    $city = $_POST['country'];
    echo $sql ="UPDATE `tours` SET `date` = '$date', `venue` = '$venue', `country` = '$city' WHERE `id` = $id";

    if ($Db->query($sql)) {
        header("Location: edittours.php");
        $Db->disconnect();
    } else {
        echo "<p>Error updating record!</p>\n\t</body>\n</html>";
    }
    $Db->disconnect();

} else if ($_POST['action'] == 'Delete') {
    $Db->connect();
    $id= $_POST['id'];

    $sql="DELETE FROM tours WHERE id=$id";
    if ($Db->query($sql)) {
        header("Location: edittours.php");
        $Db->disconnect();
    } else {
        echo "<p>Error deleting record!</p>\n\t</body>\n</html>";
    }
    $Db->disconnect();
}else{
    header("location: tours.php");
}
