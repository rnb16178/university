<?php
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();

if (isset($_POST['biography'])){
    $Db->connect();
    $sql = "UPDATE `content` SET `content` = '".$_POST['biography']."' WHERE `content`.`id` =".$_POST['id']."";
    if($Db->insert($sql)){
        echo"success";
        header("Location: editabout.php");
    }else{
        echo"failure";
        echo $sql;
    }
}