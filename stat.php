<!DOCTYPE html>
<head></head>
<body>
<div class="read">

<?php 

define('DB_HOST', 'localhost');
define('DB_NAME', 'rio');
define('DB_USER','root');
define('DB_PASSWORD','');

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD);

mysqli_query($con,"USE ".DB_NAME);

//get total no of unread mails
$count_result = mysqli_query($con,"SELECT COUNT(*) FROM data where read_receipt=\"0\"");
$count=mysqli_fetch_array($count_result);
if($count[0]=="0"){
	echo '<p>You have no unread mails.</p>';
}
else if($count[0]=="1"){
	echo '<p>You have '.$count[0].' unread mail.';	
}
else{
	echo '<p>You have '.$count[0].' unread mails.';	
}

if($count[0]!="0"){
	//get count of each intent type
	$result = mysqli_query($con,"SELECT DISTINCT intent, COUNT(*) FROM data GROUP BY intent");
	$i=1;
	while ($row=mysqli_fetch_array($result)) {
      $unread_count_result = mysqli_query($con,"SELECT COUNT(*) FROM data where `intent`=\"".$row[0]."\" and `read_receipt`=\"0\"");
      $unread_count=mysqli_fetch_array($unread_count_result);
      if($unread_count[0]!="0"){
      		if($i!=4){
	      		echo $unread_count[0].' mails in the '.str_replace("_"," ",$row[0]).' category, ';
	      	}
	      	else{
	      		echo ' and '.$unread_count[0].' mails in the '.str_replace("_"," ",$row[0]).' category.';
	      	} 
  	  }
  	  $i=$i+1;
  	}
}

echo '</p>';

?>

</div>
</body>
</html>
