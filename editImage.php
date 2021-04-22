<?php
include 'classes/Gallery.php';
$gallery = new Gallery();
echo $description = $_POST['description'];
echo $id=filter_input(INPUT_POST, 'id');

if (isset($_FILES['my_image'])){
    echo $oldimage= $_POST['oldimage'];
    echo $newimage = $_POST['newimage'];
    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];
    $gallery->updateImage($oldimage, $newimage, $id, $img_name, $img_size, $tmp_name, $error);

}
$gallery->updateDesc($description, $id);
