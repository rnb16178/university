<?php
class Discography extends Db
{

    public function displayDiscographyEdit()
    {
        if ($_SESSION['logged-in']) {
            $this->connect();
            $sql = "SELECT * FROM discography WHERE type = 'album'";
            $result = $this->select($sql);
            if ($result->num_rows > 0) {
?>
                <div class=album-container>
                    <h1>Albums</h1>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='album'>
                <h2>" . $row["name"] . "</h2>
                <a  href='deletealbum.php?album=" . $row["name"] . "'>Delte Album</a>";
                        echo "<br><img width= 300px src='uploads/" . $row['imagename'] . "'/><br>";
                    ?>
                        <form action="uploadimage.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="my_image">
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <input type="hidden" name="oldPhoto" value="<?php echo $row['imagename'] ?>">
                            <input type="submit" name="submit" value="Upload">
                        </form>
                        <?php
                        echo "<br><h3>About</h3>
                <form method='post' action='updateabout.php'>
                    <textarea>" . $row['about'] . "</textarea>
                    <input type='submit' class='save-button' name='discography' value='Save About'>
                </form>

                <br><hr><br><h3>Tracks</h3>";
                        $sql = "SELECT * FROM tracks WHERE album = '" . $row["name"] . "'";
                        echo "<table>";
                        $result2 = $this->select($sql);
                        if ($result2) {

                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    echo "<form method='get' action='updatetrack.php' >
                        <tr>
                        <td><input type='text'value='" . $row2["title"] . "' name='title''></td>
                        <td><a href=\"deletetrack.php?id=" . $row2["id"] . "\">Delete</a></td><td><input type='submit' value='save'></td>
                        </tr></form>";
                                }
                            }
                        }

                        echo "
                <form method='post' action='addtrack.php'><tr>
                    <td><input type='text' placeholder='Add a new Track' name='title''></td>
                    <td><input type='submit'</td>
                    <input type='hidden' name='album' value='" . $row['name'] . "'>
                    </tr>
                </form>
               </table>";
                        echo "</div>";
                        ?>


                    <?php



                    }
                    echo '<div class="album">
                    <h2>Create New Album</h2>
                    <form method="get" action="createalbum.php">
                        <input type="file">
                        <textarea></textarea>
                        <input type="submit" value="save Album">
                    </form>
                </div>';
                    echo '</div><br>';
                }
                $sql = "SELECT * FROM discography WHERE type = 'single'";
                $result = $this->select($sql);
                if ($result->num_rows > 0) {
                    echo "<div class=album-container><h1>Singles</h1>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='album'>";
                        echo "<h2>" . $row["name"] . "</h2>";
                        echo "<br><img width= 300px src='uploads/" . $row['imagename'] . "'/><br>";
                    ?>
                        <h3>Change Image</h3>
                        <form action="uploadimage.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="my_image">
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <input type="submit" name="submit" value="Upload">
                        </form>
                <?php
                        echo $row["about"];
                        echo "<p> " . $row["tracks"], "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                }
                $this->disconnect();

                ?>
                </div>
    <?php
        } else {
            header("Location: discography.php");
        }
    }

    public function displayDiscography()
    {
        $this->connect();
        $sql = "SELECT * FROM discography WHERE type = 'album'";
        $result = $this->select($sql);
        if ($result->num_rows > 0) {
            echo "<div class=album-container><h1>Albums</h1>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='album'>";
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<br><img width= 300px src='uploads/" . $row['imagename'] . "'/><br>";
                echo "<br><h3>About</h3>" . $row["about"];
                echo "<br><hr><br><h3>Tracks</h3>";
                $sql = "SELECT * FROM tracks WHERE album = '" . $row["name"] . "'";
                $result2 = $this->select($sql);
                if ($result2) {
                    if ($result2->num_rows > 0) {
                        echo "<ul>";
                        while ($row2 = $result2->fetch_assoc()) {
                            echo "
                        <li>" . $row2["title"] . "</li>";
                        }
                        echo "</ul>";
                    }
                }
                echo "</div>";
            }
            echo '</div><br>';
        }
        $sql = "SELECT * FROM discography WHERE type = 'single'";
        $result = $this->select($sql);
        if ($result->num_rows > 0) {
            echo "<div class=album-container><h1>Singles</h1>";

            while ($row = $result->fetch_assoc()) {
                echo "<div class='album'>";
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<br><img width= 300px src='uploads/" . $row['imagename'] . "'/><br>";
                echo $row["about"];
                echo "<p> " . $row["tracks"], "</p>";
                echo "</div>";
            }
            echo "</div>";
        }
        $this->disconnect();
    }
}
