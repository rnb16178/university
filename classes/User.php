<?php
class User extends Db
{
    private $email;
    private $password;
    private $name = "";

    function __construct()
    {
        if (!isset($_SESSION['logged-in'])) {
            $_SESSION['logged-in'] = false;
        }
    }

    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function login()
    {
        if (!(isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"]))) {
            header("WWW-Authenticate: Basic realm='restricted Access'");
            header("HTTP/1.0 401 Unauthorised");
        } else {
            $emailTemp = $_SERVER["PHP_AUTH_USER"];
            $passwordTemp = $_SERVER["PHP_AUTH_PW"];

            $sql = "SELECT * FROM admin WHERE email ='$emailTemp'";
            $Db = new Db();
            $Db->connect();
            $result = $Db->select($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['password'] == $passwordTemp) {

                        echo "<h2>Welcome Admin</h2>";
                        echo "<p>Have a nice day</p>";
                        $this->email = $_SERVER["PHP_AUTH_USER"];
                        $this->password = $_SERVER["PHP_AUTH_PW"];
                        $_SESSION['logged-in'] = true;
                    } else {
                        header("WWW-Authenticate: Basic realm='restricted Access'");
                        header("HTTP/1.0 401 Unauthorised");
                    }
                }
            }else{
                header("WWW-Authenticate: Basic realm='restricted Access'");
                header("HTTP/1.0 401 Unauthorised");
            }
        }
    }

    public function logout()
    {
    }
}
