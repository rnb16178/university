<?php
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();
 $id = filter_input(INPUT_GET, "id");
 $title = filter_input(INPUT_GET, "title");

$Db->connect();
$sql="UPDATE `tracks` SET `title` = '$title' WHERE `id` = $id";

if($Db->query($sql)){
    header("Location: editDiscography.php");
    $Db->disconnect();
}else{
    echo "<p>Error deleting record!</p>\n\t</body>\n</html>";
}
$Db->disconnect();

