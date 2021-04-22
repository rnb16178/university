
<?php
include 'classes/Database.php';
$database = new Db();
$database->connect();

$name =filter_input(INPUT_POST, "name");
$email =filter_input(INPUT_POST, "email");
$message =filter_input(INPUT_POST, "message");
$sql = "INSERT INTO `contact-form` (`id`, `name`, `email`, `message`) VALUES (NULL, \"$name\", \"$email\", \"$message\");";
if ($database->insert($sql)) {
    echo "<script> alert('Record successfully inserted');</script>";
    header("Location: index.php");
    $conn->close();
} else {
    echo "<script> alert('Record not inserted');</script>";
}
$database->disconnect();
?>