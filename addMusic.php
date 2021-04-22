<?php
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();
session_start();

$url = filter_input(INPUT_POST, "url");
echo $url."<br>";
$url = explode("=",$url);
echo $url[1];

$Db->connect();
$sql="INSERT INTO `music` (`id`, `url`) VALUES (NULL, 'https://www.youtube.com/embed/".$url[1]."')";
$Db->query($sql);
header("location: editmusic.php");
$Db->disconnect();
?>