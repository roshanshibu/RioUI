<?php 
$timePOST = $_POST['timePOST'];
$mailPOST = $_POST['mailPOST'];

$test1 ="test1";
$test2 ="test2";

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

//$sql = "UPDATE data SET read_receipt='1' WHERE time=".$timePOST."";
$sql = "UPDATE data SET `read_receipt`='1' WHERE time ='".$timePOST."'";
//$sql = "UPDATE data SET `read_receipt`='1' WHERE time ='".$timePOST."' AND mail = '".$mailPOST."'";
//echo $sql;


if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$count_result = mysqli_query($conn,"SELECT COUNT(*) FROM data where read_receipt=\"0\"");
$count=mysqli_fetch_array($count_result);
echo "all*";
echo $count[0]."#";

$result = mysqli_query($conn,"SELECT DISTINCT intent, COUNT(*) FROM data GROUP BY intent");
while ($row=mysqli_fetch_array($result)) {
	$unread_count_result = mysqli_query($conn,"SELECT COUNT(*) FROM data where `intent`=\"".$row[0]."\" and `read_receipt`=\"0\"");
	$unread_count=mysqli_fetch_array($unread_count_result);
	echo $row[0]."*";
	echo $unread_count[0]."#";
}



$conn->close();
?>