<?php
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();

session_start();

$id = filter_input(INPUT_GET, "id");
$Db->connect();
$sql= "DELETE FROM music WHERE id = $id";
$Db->delete($sql);
header("Location: editmusic.php");
