<html>
<head>
	 <script src="jquery-3.3.1.min.js"></script>
</head>
<body>

 <div id='rows'></div>
<?php 
	$conn = new mysqli('localhost', 'root', '', 'rio');
	if ($conn->connect_error) {
	die("Connection error: " . $conn->connect_error);
	}

	$result = mysqli_query($conn, "SELECT MAX(time) FROM data");
	$row = mysqli_fetch_array($result);
	$baseval=$row[0];
?>
<script>
 var base= <?php echo $baseval ?>;
 alert("Initial Base is:" + base);
  jQuery(function($){
  $("#rows").load("data.php");
  setInterval(function(){
    $.get( 'compare.php', function(maxVal){
			console.log(maxVal);
			//alert("MAX VAL IS :" + maxVal);
			if(maxVal>base)
			{$("#rows").load("data.php");
			base=maxVal;
			alert("NEW BASE VALUE IS:" +base);
			}
			else
			{
			//alert("YOU HAVE REACHED HERE");
			}
										
	});
  },3000);});


</script>
<input type="text" id="mailtext"/>
</body>
</html>