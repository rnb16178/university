<?php
include 'classes/Database.php';
$Db = new Db();
$Db->connect();
if ($_POST['action'] == 'Update') {
    //action for update here

    echo $position =$_POST['position'];
    echo $name=$_POST['name'];
    echo $id=$_POST['id'];
    echo isset($_FILES['my_image']);
    if (isset($_FILES['my_image'])) {
        $oldPhoto= filter_input(INPUT_POST, "oldPhoto");
        //delete old photo from file
        if(isset($oldPhoto)){
            unlink("uploads/".$oldPhoto);
        }
    
        $Db->connect();
    
        echo "<pre>";
        print_r($_FILES['my_image']);
        echo "</pre>";
    
        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];
        $id=$_POST['id'];
        var_dump($img_name);
        if ($error === 0) {
            if ($img_size > 1250000) {
                echo $em = "Sorry, your file is too large.";
                //header("Location: index.php?error=$em");
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png");
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = 'uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
    
                    // Insert into Database
                    echo $sql = "UPDATE members SET imagename = '$new_img_name'
                            WHERE id=$id";

                    if(!$Db->query($sql)){
                        echo "<p>Error deleting record!</p>\n\t</body>\n</html>";
                    }
                } else {
                    echo $em = "You can't upload files of this type";
                    //header("Location: index.php?error=$em");
                }
            }
        } else {
            echo $em = "unknown error occurred!";
            //header("Location: index.php?error=$em");
        }
    } else {
    echo "something empty";
        //header("Location: editdiscography.php");
    }
    
          
    $sql = "UPDATE `members` SET `name` = '".$name."', position='".$position."' WHERE `id` =".$id;
    //echo $sql;
    if ($Db->insert($sql)) {
        $Db->disconnect();
        header("Location: editAbout.php");
    } else {
        echo "<script> alert('Record not inserted');</script>";
    }

} else if ($_POST['action'] == 'Delete') {
    //action for delete
    $oldPhoto= filter_input(INPUT_POST, "oldPhoto");
    unlink("uploads/".$oldPhoto);

    $sql="DELETE FROM `members` WHERE `id` = ".$_POST['id'];
    if ($Db->insert($sql)) {
        $Db->disconnect();
        header("Location: editAbout.php");
    } else {
        echo "<script> alert('Record not inserted');</script>";
    }

}