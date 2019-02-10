<html>
<script src="jquery.min.js"></script>
<head>


<?php 
$conn = new mysqli('localhost', 'root', '', 'rio');
if ($conn->connect_error) {
die("Connection error: " . $conn->connect_error);
}
$result = mysqli_query($conn, "SELECT MAX(time) FROM data");
$row = mysqli_fetch_array($result);
$baseval=$row[0];
?>

<script language="JavaScript">
	//get largest intial value of time in db
	var base= <?php echo $baseval ?>;

	jQuery(function($){
	  $("#rows").load("data.php");
	  setInterval(function(){
	    $.get( 'compare.php', function(maxVal){
				console.log(maxVal);
				//alert("MAX VAL IS :" + maxVal);
				if(maxVal>base)
				{
				location.reload();
				base=maxVal;
				//alert("NEW BASE VALUE IS:" +base);
				}
				else
				{
				//alert("YOU HAVE REACHED HERE");
				}
											
		});
	  },3000);});

	function showInput(clicked_id,mail_subject,mail_sender,mail_intent,mail_entity,mail_intent_score,mail_sentiment,mail_sentiment_score){

	document.getElementById("mailsubject").innerText = mail_subject;
	document.getElementById("mailintent").value=mail_intent;
	document.getElementById("mailsender").innerText = mail_sender;
	document.getElementById("mailintentscore").value=mail_intent_score;
	document.getElementById("mailsentiment").value=mail_sentiment;
	document.getElementById("mailsentimentscore").value=mail_sentiment_score;
	
	
	document.getElementById("mailtext").value=clicked_id;
	var but = document.getElementById(clicked_id);
    //but.style.backgroundColor = "#bbe2ed"
	
	document.getElementById("accuracyTest").style.display = "block";
	document.getElementById("trainMenu").style.display = "none";
	document.getElementById("boast").style.display = "none"; 
	}
	
	function showTrainMenu(){
		document.getElementById("accuracyTest").style.display = "none"; 
		document.getElementById("trainMenu").style.display = "block"; 

	}
	
	function showBoast(){
		document.getElementById("accuracyTest").style.display = "none"; 
		document.getElementById("boast").style.display = "block"; 

	}

	function TrainFunc(){
		var utterance = document.getElementById("mailtext").value;
		var intent =  document.getElementById("intents").value;
		$.ajax({
            type : "POST",  //type of method
            url  : "addTrainingData.php",  //your page
            data : { "utterance" : utterance, "intent" : intent },// passing the values
            success: function(res){  
                                alert("Training data has been stored");    //do what you want here...
                    }
        });
	}



</script>
<style>
@font-face {
  font-family: 'fira';
  src: url('FiraSans-Regular.ttf');
  font-style: normal;
}

@font-face {
  font-family: 'proximanova';
  src: url('Arvo-Regular.ttf');
  font-style: normal;
}



body {
  font-family: fira;
  color: white;
}

.split {
  height: 100%;
  width: 30%;
  position: fixed;
  z-index: 1;
  top: 0;
  overflow-x: hidden;
}

.left {
  left: 0;
  background-color: white;
}

.right {
  height: 60%;
  width: 70%;
  right: 0;
  padding-top: 25px;
  background-color: white;
}

.rightb {
  position: fixed;
  bottom: 0;
  right: 0;
  background-color: #f7f7f7;
  height:35%;
  width: 70%;
}


.block {
  border-top: 1px solid #d8d8d8;
  border-bottom: none;
  border-right: none;
  border-left: none;
  font-family: inherit;
  width: 100%;
  padding: 10px 1px;
  font-size: 16px;
  cursor: pointer;
  background-color:#fcfcfc;
  text-align: left;
  }
.intent {
  border-radius: 4px;
  pointer-events: none;
  display:inline-block;
  font-family: inherit;
  width: auto;
  border: none;
  background-color: #dddddd;
  padding: 5px ;
  font-size: 12px;
  cursor: pointer;
  color: black;
  text-align: left;
  margin-left: 15px;
  margin-top: 5px;
  margin-bottom: 5px;
}

.entity {
  border-radius: 4px;
  pointer-events: none;
  display:inline-block;
  font-family: inherit;
  width: auto;
  border: none;
  background-color: #0a9ac2;
  padding: 5px ;
  font-size: 12px;
  cursor: pointer;
  color: white;
  text-align: left;
  margin-left: 10px;
  margin-top: 5px;
  margin-bottom: 5px;
}

.block:hover {
  /*box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.59);*/
  background-color: #e8e8e8;
}

.train {
  font-family: inherit;
  border-radius: 4px;
  display: inline-block;
  width: 11%;
  height: 22%;
  border: none;
  background-color: #0a9ac2;
  font-size: 20px;
  cursor: pointer;
  color: white;
  text-align: center;
  margin-left: 10px;
  margin-top: 5px;
}
.train:hover {
  box-shadow: 0 1px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}
.mail{
	/*
  margin-left: 10px;
  margin-right: 10px;
  margin-top: 10px;
  margin-bottom: 1px;
  border-radius: 4px;
  border-style: solid;
  border-width: 2px 2px 2px 2px;
  */
}
.flex-container {
  display: flex;
  height: 100%;
  padding-top: 6%;
}

.fill-width {
  flex: 1;
  outline: none;
}
.sender {
  display:inline-block;
  font-family: inherit;
  width: 95%;
  padding: 3px 15px;
  font-size: 12px;
  text-align: left;
  color: black;
  }

 .subject {
  display:inline-block;
  font-family: inherit;
  width: 95%;
  padding: 3px 15px;
  font-size: 18px;
  text-align: left;
  color: black;
  }

input[type=text], select {
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.navbar {
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  
  overflow: hidden;
  background-color: #0a9ac2;
  position: fixed; /* Set the navbar to fixed position */
  top: 0; /* Position the navbar at the top of the page */
  width: 100%; /* Full width */
  height: 18%;
}

.big_intent {
  border-radius: 4px;
  pointer-events: none;
  display:inline-block;
  font-family: inherit;
  width: auto;
  border: none;
  background-color: #0a9ac2;
  padding: 5px ;
  font-size: 15px;
  cursor: pointer;
  color: white;
  text-align: left;
  margin-top: 5px;
  margin-bottom: 5px;
}

table.roundedCorners { 
  border: 1px solid #0a9ac2;
  border-radius: 4px; 
  background-color: white;
  border-spacing: 0;
  }
table.roundedCorners td, 
table.roundedCorners th { 
  border-bottom: 1px solid #0a9ac2;
  padding: 5px; 
  }
table.roundedCorners tr:last-child > td {
  border-bottom: none;
}




</style>
</head>

<body>


	

<?php 

define('DB_HOST', 'localhost');
define('DB_NAME', 'rio');
define('DB_USER','root');
define('DB_PASSWORD','');

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD);

mysqli_query($con,"USE ".DB_NAME);
    
    echo '<div class="split left">';
	echo '<div class="navbar"><h1 style="padding-top:16px;padding-left:15px;color:white;">RiO</h1></div><br><br><br><br><br><br><br>';
    $maxres = mysqli_query($con,"SELECT MAX(time) FROM data ;");
	$max=mysqli_fetch_array($maxres);
	echo '<textarea name="hide" style="display:none;" id="maxval">$max[0]</textarea>';
	
	$result = mysqli_query($con,"SELECT * FROM data ORDER BY time DESC;");
	while ($row=mysqli_fetch_array($result)) {

			echo '<button class="block" id="'.$row[2].'" onclick="showInput(this.id,\''.$row[1].'\',\''.$row[0].'\',\''.$row[3].'\',\''.$row[4].'\',\''.$row[5].'\',\''.$row[6].'\',\''.$row[7].'\')">';

			echo '<label  class="sender">'.$row[0].'</label>';
		
			echo '<label  class="subject" >'.$row[1].'</label>';
			
			echo '<input type="button" class="intent" value="'.$row[3].'">';
			if(!strcmp($row[3],"change_address")){
				echo '<input type="button" class="entity" value="'.$row[4].'"><br>';
			}

			echo '</button>'; 

	}

		echo '</div>';


  
		echo '<div class="rightb"><br>
					<div id="trainMenu" style="display:none;"><br>
					<center>
						<label style="color:#044548;font-family: \'fira\';padding-left:15px;">Select the appropriate intent</label><br>
		  				<select id="intents" style="margin-left:25px;height=20px;font-family:\'fira\'">
							<option value="leave_application">leave_application</option>
						  	<option value="password_change_request">password_change_request</option>
						  	<option value="change_address">change_address</option>
						  	<option value="None">None</option>
						</select> 
						<button class="train" onclick="TrainFunc()">Train</button>
						</center>
		  			</div>

		  			<div id="accuracyTest">
		  				<center>
		  				 <table style="width:80%;color:black;" class="roundedCorners">
						  <tr>
						    <td>Intent</td>
						    <td><input type="button" id="mailintent" class="big_intent" value=""></td>
						    <td>Sentiment</td>
						    <td><input type="button" id="mailsentiment" class="big_intent" value=""></td>
						    </tr>
						  <tr>
						  	<td>Intent Score</td>
						    <td><input type="button" id="mailintentscore" class="big_intent" value=""></td>
						    <td>Sentiment Score</td>
						  	<td><input type="button" id="mailsentimentscore" class="big_intent" value=""></td>
						  </tr>
						</table> <br>
						<label style="color:#044548;font-family: \'fira\';">Was this intent accurate?</label><br>
						<button class="train" onclick="showBoast()">Yes</button>
						<button class="train" onclick="showTrainMenu()" >No</button>
						</center>
		  			</div>

					<div id="boast" style="display:none;">
		  				<center>
		  				<br>
						<p style="color:#044548;margin-left:15px;font-family: \'fira\';">Ofcourse it is, our model is flawless!</p>
						</center>
		  			</div>

			</div>';

		
		echo '<div class="split right">
		<div class="navbar"><br>
			<label id="mailsubject" style="color:white;margin-bottom:6px;padding-left:25px;font-size:29px"></label>
			<br>
			<label style="color:#e8e8e8; padding-left:25px;font-size:16px;">From: </label>
  			<label id="mailsender" style="color:#e8e8e8;padding-left:5px;margin-bottom:15px;"></label>
  			<br><br>
  			
		</div>
			<div class="flex-container">
			<textarea readonly rows="4" cols="50" class="fill-width" id="mailtext" 
					style ="border: none;
					border-color:transparent;
					padding-left:25px;
					padding-top:50px;
					font-family:fira;
					color:#2b2b2b;
					font-size: 20px;
					background-color:white" />';
		



?>

