<?php
include_once 'classes/Database.php';
class Gallery extends Db
{
    public function updateDesc($description, $id)
    {
        echo $sql = "UPDATE gallery SET description='$description' WHERE id=$id";

        if ($this->query($sql)) {
            header("Location: editdiscography.php");
            $this->disconnect();
        } else {
            echo "<p>Error deleting record!</p>\n\t</body>\n</html>";
        }
    }
    public function updateImage($oldimage, $newimage, $id, $img_name, $img_size, $tmp_name, $error)
    {
        $image = $oldimage;

        if (isset($newimage)) {
            $image = $newimage;
        }
        $this->connect();

        echo "<pre>";
        print_r($_FILES['my_image']);
        echo "</pre>";
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
                    $sql = "UPDATE gallery SET imagename = '$new_img_name' WHERE id=$id";
                    if ($this->query($sql)) {
                        header("Location: editdiscography.php");
                        $this->disconnect();
                    } else {
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
    }
    public function addImage($img_name, $img_size, $tmp_name, $error, $description)
    {
        $this->connect();
        echo "<pre>";
        print_r($_FILES['image']);
        echo "</pre>";
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
                    $sql = "INSERT INTO `gallery` (`id`, `filename`, `description`) VALUES (NULL, '" . $new_img_name . "', '" . $description . "');";

                    if ($this->query($sql)) {
                        header("Location: Galleryedit.php");
                        $this->disconnect();
                    } else {
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
    }

    public function displayEditMenu()
    {
        $this->connect();
        $sql = "SELECT * FROM gallery";
        $result = $this->select($sql);
        if ($result->num_rows > 0) {
            echo "<div class='album-container'>";
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="album">
                <form action="editimage.php" method="post" enctype="multipart/form-data">
                <a target="_blank" href="uploads/' . $row["filename"] . '">
                <img src="uploads/'  . $row["filename"] . '" alt="$row["filename"]"><br>
                <input name="newimage" type="file" >
                </a>
                <textarea name="description">' . $row["description"] . '</textarea>
                <input type="hidden" name="oldimage" value="'  . $row["filename"] . '">
                <input type="hidden" name="id" value="'  . $row["id"] . '">
                <input type="submit" name="save" value="save">
                <a href="deleteimage.php?id=' . $row["id"] . '&oldimage=' . $row["filename"] . '">Delete</a>
                </div>';
            }
            echo '</form></div><br>';
        } else {
            echo "<h1>There are no photos in the gallery at the moment</h1>";
        }
?>
        <div class="album-containter">
            <form action="addImage.php" method="post" enctype="multipart/form-data">
                <input name="image" type="file">
                <textarea name="description"></textarea>
                <input type="submit" name="save" value="save">
        </div>
        </form>
<?php
        $this->disconnect();
    }

    public function displayGallery()
    {
        $this->connect();
        $sql = "SELECT * FROM gallery";
        $result = $this->select($sql);
        if ($result->num_rows > 0) {
            echo "<div class=member-container><h1>Band Members</h1>";
            while ($row = $result->fetch_assoc()) {
                echo '<div class="gallery">
        <a target="_blank" href="uploads/' . $row["filename"] . '">
            <img src="uploads/' . $row["filename"] . '" alt="" width="600" height="400">
        </a>
        <div class="desc">' . $row["description"] . '</div>
    </div>';
            }
            echo '</div><br>';
        } else {
            echo "<h1>There are no photos in the gallery at the moment</h1>";
        }

        $this->disconnect();
    }
    public function hello()
    {
        $this->connect();
        $this->disconnect();
        return "hello from Gallery";
    }
}
