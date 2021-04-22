<?php

include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();
 $album = filter_input(INPUT_POST, "album");
 $title = filter_input(INPUT_POST, "title");

$Db->connect();

echo $sql="INSERT INTO `tracks` (`id`, `title`, `album`) VALUES (NULL, '".$title."', '".$album."')";

if($Db->query($sql)){
    //header("Location: editDiscography.php");
    $Db->disconnect();
}else{
    echo "<p>Error deleting record!</p>\n\t</body>\n</html>";
}
$Db->disconnect();

