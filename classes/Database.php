<?php
class Db{
    private $host ="localhost";
    private $user="root";
    private $pwd="";
    private $dbName="monster-truck";
    private $conn;
    private $connected=false;
    private $result;

    public function connect(){
        if(!$this->connected){
            $this->conn = new mysqli($this->host,$this->user,$this->pwd,$this->dbName);
            if ($this->conn->connect_error) {
                die("<p>Connection failed!</p>\n\t</body>\n</html>");
            }else{
                $this->connected=true;
            }
        }
    }

    public function disconnect(){
        if($this->connected){
            $this->conn->close();
            $this->connected=false;
        }
    }

    public function select($sql){
        return $this->conn->query($sql);
        

    }

    public function insert($sql){
        if($this->connected){
            if($this->conn->query($sql)){
                return true;
            }else{
                return false;
            }
        }

    }

    public function delete($sql){
        if($this->connected){
            if($this->conn->query($sql)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function query($sql){
        if($this->connected){
            if($this->conn->query($sql)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function getResult(){
        return $this->result;
    }

}

class Music extends Db{
    public function delete($id){
        $this->connect();
        $sql = "DELETE FROM music WHERE id = $id";
        $this->delete($sql);
        header("Location: editmusic.php");
    }
}