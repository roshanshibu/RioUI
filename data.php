<html>

<head>
<script language="JavaScript">
	function showInput(){
	document.getElementById("mailtext").id; 
	tb.value="test";
	}
</script>

</head>

<body>
<center>

<?php 

define('DB_HOST', 'localhost');
define('DB_NAME', 'rio');
define('DB_USER','root');
define('DB_PASSWORD','');

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD);

mysqli_query($con,"USE ".DB_NAME);
      
$result = mysqli_query($con,"SELECT * FROM data ORDER BY time DESC;");

	while ($row=mysqli_fetch_array($result)) {
		
			echo '<button type="button" id="'.$row[2].'" onclick="showInput()">'.$row[1].'</button><br>';
			
			echo '<input type="button" value="'.$row[3].'">';
			
			echo '<input type="button" value="'.$row[4].'"><br>';
	}

?>

<input type="text" id="mailtext"/>
</body>
</center>
</html>