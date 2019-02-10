<?php


$conn = new mysqli('localhost', 'root', '', 'rio');
if ($conn->connect_error) {
	die("Connection error: " . $conn->connect_error);
}

$result = mysqli_query($conn, "SELECT MAX(time) FROM data");
$row = mysqli_fetch_array($result);
$currentmaxval=$row[0];

echo $currentmaxval;

?>