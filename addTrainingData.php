<?php 
$utterance = $_POST['utterance'];
$intent = $_POST['intent'];

$utterance = str_replace("'", " ", $utterance);
$utterance = str_replace("\"", " ", $utterance);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO train VALUES ('".$utterance."', '".$intent."',0)";

//echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>