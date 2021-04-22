<?php
require_once "Database.php";
class Music extends Db{
    public function delete($id){
        $this->connect();
        $sql = "DELETE FROM music WHERE id = $id";
        $this->delete($sql);
        header("Location: editmusic.php");
    }
}
