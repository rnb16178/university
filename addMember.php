<?php
include 'classes/Database.php';
include 'classes/About.php';

$database = new Db();
$about = new About();

if (null!==(filter_input(INPUT_POST, "addmember"))) {
    $name = filter_input(INPUT_POST, "name");
    $position = filter_input(INPUT_POST, "position");
    $image = filter_input(INPUT_POST, "my_image");
    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];


    $about->addMember($name, $position, $image, $img_name, $img_size, $tmp_name,$error);
}