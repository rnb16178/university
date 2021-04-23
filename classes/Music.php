<?php
class Music extends Db{

    public function delete($id){
        $this->connect();
        $sql = "DELETE FROM music WHERE id = $id";
        $this->delete($sql);
        header("Location: editmusic.php");
    }
    public function displayMusic()
     {
        $this->connect();
            $sql = "SELECT * from music";
            $result = $this->select($sql);
            if ($result->num_rows > 0) {

                echo '<div class="album-container">';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="album">
                    <iframe width="600px" height="300px" src="'.$row['url'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>';
                }
                echo '</div>';
            } else {
                echo '<p>There are no music videos available at the moment</p>';
            }
            
     }
     public function displayEditMusic()
     {
        if ($_SESSION['logged-in']) {

            $this->connect();
            $sql = "SELECT * from music";
            $result = $this->select($sql);
            if ($result->num_rows > 0) {

                echo '<div class="album-container">';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="album">
                    <iframe width="600px" height="300px" src="' . $row['url'] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <a href="deletevideo.php?id='.$row["id"].'">delete</a>
                    </div>';
                }
                echo '</div>';
            } else {
                echo '<p>There are no music videos available at the moment</p>';
            }
        ?>
        <div class="form">
            <p>Add new music video</p>
            <form method="POST" action="addMusic.php">
                <input type="text" name="url" placeholder="Url" required>
                <input type="submit" name="submit" value="save">
            </form>
        </div>
        <?php

        } else {
            header("Location: music.php");
        }
        
     }
}
