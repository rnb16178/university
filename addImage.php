<?php
include 'classes/Gallery.php';
$gallery = new Gallery();
echo $image= filter_input(INPUT_POST, "image");
echo $description= filter_input(INPUT_POST, "description");
$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];
$tmp_name = $_FILES['image']['tmp_name'];
$error = $_FILES['image']['error'];
$gallery->addImage($img_name,$img_size,$tmp_name,$error, $description);
?>