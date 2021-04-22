<?php
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();
 $album = filter_input(INPUT_GET, "album");
 $Db->connect();

echo $sql="DELETE FROM tracks WHERE album='$album'";
if($Db->query($sql)){
    echo $sql="DELETE FROM discography WHERE name='$album'";

    if($Db->query($sql)){
            header("Location: editDiscography.php");
            $Db->disconnect();
    }else{
        echo "<p>Error deleting record!</p>\n\t</body>\n</html>";
    }
}else{
    echo "<p>Error deleting record!</p>\n\t</body>\n</html>";
}