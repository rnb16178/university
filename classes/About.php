<?php
class About extends Db
{

    public function addMember($name, $position, $image, $img_name, $img_size, $tmp_name, $error)
    {
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
                    $sql = "INSERT INTO `members` (`id`, `name`, `position`, `imagename`) VALUES (NULL, \"$name\", \"$position\", \"$new_img_name\");";
                    if ($this->insert($sql)) {
                        header("Location: editAbout.php");
                        $this->disconnect();
                    } else {
                        echo "<script> alert('Record not inserted');</script>";
                    }
                    $this->disconnect();
                   
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
    public function delelteMember($id)
    {
        echo $id;
        $this->connect();
        $sql="DELETE FROM `members` WHERE `members`.`id` = ".$id;
        if ($this->delete($sql)) {
            $this->disconnect();
            header("Location: editAbout.php");
        } else {
            $this->disconnect();
            echo "<script> alert('Record not deleted');</script>";
        }
    
    }
    public function editMember($position, $name, $img_name, $img_size, $tmp_name, $error,$id)
    {

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
                    echo $sql = "UPDATE members SET imagename = '$new_img_name'
                            WHERE id=$id";

                    if(!$this->query($sql)){
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
   
          
    $sql = "UPDATE `members` SET `name` = '".$name."', position='".$position."' WHERE `id` =".$id;
    //echo $sql;
    if ($this->insert($sql)) {
        $this->disconnect();
        header("Location: editAbout.php");
    } else {
        echo "<script> alert('Record not inserted');</script>";
    }
    }



    
    public function deleteOldImage($filename)
    {
        if (isset($filename)) {
            unlink("uploads/" . $filename);
        }
    }

    public function saveBiography($biography, $id)
    {
        $this->connect();
        $sql = "UPDATE `content` SET `content` = '" . $biography . "' WHERE `content`.`id` =" . $id . "";
        if ($this->insert($sql)) {
            echo "success";
            header("Location: editabout.php");
        } else {
            echo "failure";
        }
    }
    public function displayEditAbout()
    {

        if ($_SESSION['logged-in']) {
?>
            <div class="biography">
                <h1>Biography</h1>
                <?php
                $this->connect();
                $sql = "SELECT * FROM content WHERE section = 'about'";
                $result = $this->select($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<form action='saveBio.php' method='post'>
                        <textarea name='biography' rows ='10' style='width: 100%;'>" . $row['content'] . "</textarea>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='submit' value='Save'>
                        </form>";
                    }
                }
                echo '</div>';
                $sql = "SELECT * FROM members";
                $result = $this->select($sql);
                if ($result->num_rows > 0) {
                    echo "<div class=member-container><h1>Band Members</h1>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='member'><form action='editMember.php' method='post'enctype='multipart/form-data'>";
                        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                        echo '<input type="hidden" name="oldPhoto" value="' . $row['imagename'] . '">';
                        echo "<img width= 300px src='uploads/" . $row['imagename'] . "'/><br>";
                        echo "<input type='file' name='my_image' >";
                        echo "<input type='text' name='name' value='" . $row["name"] . "'>";
                        echo "<input type='text' name='position' value='" . $row["position"] . "'>";
                        echo '<input type="submit" name="action" value="Update" />
                          <input type="submit" name="action" value="Delete" />';
                        echo "</form></div>";
                    }
                    echo '</div><br>';
                }

                $this->disconnect();
                ?>
                <div class="member-form">
                    <p>Add new Band Member</p>
                    <form action="addMember.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="addmember" value="true">
                        <input type='file' name='my_image' >
                        <input type="text" name="name" placeholder="name">
                        <input type="text" name="position" placeholder="position">
                        <input type="submit" name="save">
                    </form>
                </div>
                <?php;
  
        ?>
            </div>
<?php
        } else {
            header("Location: about.php");
        }
    }


    //display about page content
    public function displayAbout()
    {

        $this->connect();
        $sql = "SELECT * FROM content WHERE section = 'about'";
        $result = $this->select($sql);

        if ($result->num_rows > 0) {
            echo "<h1>Biography</h1>";
            while ($row = $result->fetch_assoc()) {

                echo "<p>" . $row['content'] . "</p>";
            }
        }
        echo '</div>';
        $sql = "SELECT * FROM members";
        $result = $this->select($sql);
        if ($result->num_rows > 0) {
            echo "<div class=member-container><h1>Band Members</h1>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='member'>";
                echo "<img width= 300px src='uploads/" . $row['imagename'] . "'/><br>";
                echo "<h2>" . $row["name"] . "</h2>";

                echo "<h3> " . $row["position"], "</h3>";
                echo "</div>";
            }
            echo '</div><br>';
        }

        $this->disconnect();
    }
}
