<?php
include 'classes/Database.php';
include 'classes/About.php';
$about = new About();
$id= filter_input(INPUT_POST, "id");
$biography= filter_input(INPUT_POST, "biography");
if (isset($id)&&isset($biography)){
    $about->saveBiography($biography,$id);
}else{
    //TODO - error message handling
}