<?php
class About extends Db
{
    public function addMember()
    {
        $this->connect();
        if (null !== filter_input(INPUT_POST, "addmember")) {
            $name = filter_input(INPUT_POST, "name");
            $position = filter_input(INPUT_POST, "position");
            $image = filter_input(INPUT_POST, "image");
            $sql = "INSERT INTO `members` (`id`, `name`, `position`, `photo`) VALUES (NULL, \"$name\", \"$position\", \"$image\");";
            if ($this->insert($sql)) {
                header("Location: editAbout.php");
                $this->disconnect();
            } else {
                echo "<script> alert('Record not inserted');</script>";
            }
            $this->disconnect();
        }
    }
}
