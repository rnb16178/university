<?php
include 'classes/Database.php';
include 'classes/User.php';
$Db = new Db();

if (isset($_POST['submit'])&&isset($_POST['id']) && isset($_FILES['my_image'])) {
    $oldPhoto= filter_input(INPUT_POST, "oldPhoto");
    //delete old photo from file
    unlink("uploads/".$oldPhoto);

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
                $sql = "UPDATE discography SET imagename = '$new_img_name'
				        WHERE discography.id=$id";
                if($Db->query($sql)){
                    header("Location: editdiscography.php");
                    $Db->disconnect();

                }else{
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
