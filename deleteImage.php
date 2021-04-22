<?php
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();
//delete from uploads folder
session_start();
$id = filter_input(INPUT_GET, "id");
$oldimage = filter_input(INPUT_GET, "oldimage");
unlink("uploads/".$oldimage);

$Db->connect();
$sql= "DELETE FROM gallery WHERE id = $id";
$Db->delete($sql);
header("Location: galleryedit.php");
