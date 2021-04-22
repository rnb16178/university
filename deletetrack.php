<?php

include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();
echo $id = filter_input(INPUT_GET, "id");
$Db->connect();
$sql = "DELETE FROM tracks WHERE id = $id";
if($Db->delete($sql)){
    header("Location: editDiscography.php");
    $Db->disconnect();
}else{
    echo "<p>Error deleting record!</p>\n\t</body>\n</html>";
}
$Db->disconnect();

