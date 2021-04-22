<?php
include 'classes/Database.php';
$database = new Db();
$database->connect();
if (null!==filter_input(INPUT_POST, "addmember")) {
    $name = filter_input(INPUT_POST, "name");
    $position = filter_input(INPUT_POST, "position");
    $image = filter_input(INPUT_POST, "image");
    $sql = "INSERT INTO `members` (`id`, `name`, `position`, `photo`) VALUES (NULL, \"$name\", \"$position\", \"$image\");";
    if ($database->insert($sql)) {
        header("Location: editAbout.php");
        $conn->close();
    } else {
        echo "<script> alert('Record not inserted');</script>";
    }
    $database->disconnect();
}
