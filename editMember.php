<?php
include 'classes/Database.php';
include 'classes/About.php';

$Db = new Db();
$about = new About();
$action = filter_input(INPUT_POST, "action");

if ($action == 'Update') {
    echo"update";
    //action for update here

    $position = filter_input(INPUT_POST, "position");
    $name = filter_input(INPUT_POST, "name");
    $id = filter_input(INPUT_POST, "id");

    if (isset($_FILES['my_image'])) {
        $oldPhoto = filter_input(INPUT_POST, "oldPhoto");
        //delete old photo from file
        $about->deleteOldImage($oldPhoto);

        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];
        $about->editMember($position, $name, $img_name, $img_size, $tmp_name, $error, $id);
    }
} else if ($action == 'Delete') {
    echo "delete";
    //action for delete
    $id = filter_input(INPUT_POST, "id");
    echo "id".$id;
    $oldPhoto = filter_input(INPUT_POST, "oldPhoto");
    $about->deleteOldImage($oldPhoto);

    $about->delelteMember($id);
}
