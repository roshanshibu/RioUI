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
  height: 494px;
  width: 30%;
  position: fixed;
  
  bottom: 0;
  overflow-x: hidden;
}

.left {
  left: 0;
  background-color: #e8e8e8;
}

.right {

  width: 70%;
  right: 0;
  background-color: white;
}

.rightb {
  position: fixed;
  bottom: 0;
  right: 0;
  background-color: #fcfcfc;
  height:30%;
  width: 70%;
  border-color: black;
}

.block {
  border-right: 1px solid #d8d8d8;
  border-bottom: none;
  border-top: none;
  border-left: none;
  font-family: inherit;
  width: 25%;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  background-color:#fcfcfc;
  text-align: left;
  }

  .block:hover {
  /*box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.59);*/
  background-color: #e8e8e8;
}

.blockx {
  border-bottom: 1px solid #d8d8d8;
  border-top: none;
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

  .blockx:hover {
  /*box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.59);*/
  background-color: #e8e8e8;
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


 .intent {
  display:inline-block;
  font-family: inherit;
  padding-top: 15px; 
  font-size: 18px;
  text-align: left;
  color: black;
  }

.count {
  border-radius: 5px;
  pointer-events: none;
  display:inline-block;
  font-family: inherit;
  width: auto;
  border: none;
  background-color: #0a9ac2;
  padding: 8px ;
  font-size: 20px;
  cursor: pointer;
  color: white;
  text-align: left;
  margin-left: 10px;
  margin-top: 5px;
  margin-bottom: 5px;
  float: right;
}

.sender {
  display:inline-block;
  font-family: inherit;
  width: 95%;
  padding: 3px 15px;
  font-size: 12px;
  text-align: left;
  color: #848484;
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


.intentx {
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

.navbar {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  overflow: hidden;
  background-color: #0a9ac2;
  position: fixed; /* Set the navbar to fixed position */
  top: 0; /* Position the navbar at the top of the page */
  left: 0;
  width: 100%; /* Full width */
  height: auto;
}

.flex-container {
  display: flex;
  height: 100%;
  padding-top: 15px;

}

.fill-width {
  flex: 1;
  outline: none;
}

input[type=text], select {
  width: 30%;
  padding: 8px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
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
  padding-left: 5px; 
  padding-right: 5px; 
  }
table.roundedCorners tr:last-child > td {
  border-bottom: none;
}

.intentdisp {
  border-radius: 4px;
  pointer-events: none;
  display:inline-block;
  font-family: inherit;
  width: auto;
  border: none;
  background-color: #0a9ac2;
  padding: 5px ;
  font-size: 14px;
  cursor: pointer;
  color: white;
  text-align: left;
  margin-left: 15px;
  margin-top: 5px;
  margin-bottom: 5px;
}

.train {
  font-family: inherit;
  border-radius: 4px;
  display: inline-block;
  width: auto;
  height: auto;
  border: none;
  padding-left: 14px;
  padding-right: 14px;
  padding-top: 4px;
  padding-bottom: 4px;
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


.scroller {
  scrollbar-color: #e0e0e0 white;
  overflow-y: scroll;
  scrollbar-width: thin;
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

echo '<div class="split left scroller">';

$result = mysqli_query($con,"SELECT * FROM data  WHERE intent =\"None\" ORDER BY time DESC;");
while ($row=mysqli_fetch_array($result)) {

      echo '<button class="blockx" id="'.$row[2].'" onclick="showInput(this.id,\''.$row[1].'\',\''.$row[0].'\',\''.$row[3].'\',\''.$row[4].'\',\''.$row[5].'\',\''.$row[6].'\',\''.$row[7].'\')">';

      echo '<label  class="sender">'.$row[0].'</label>';
    
      echo '<label  class="subject" >'.$row[1].'</label>';
      
      echo '<input type="button" class="intentx" value="'.$row[3].'">';
      if(!strcmp($row[3],"change_address")){
        echo '<input type="button" class="entity" value="'.$row[4].'"><br>';
      }

      echo '</button>'; 

}

echo '</div>';




echo ' <div class="split right scroller">
            <br><br>
            <label id="mailsubject" style="color:#3f3f3f;padding-left:25px;font-size:25px"></label>
            <br>
            <label style="color:#848484; padding-left:25px;font-size:15px;">From: </label>
            <label id="mailsender" style="color:#848484;padding-left:5px;font-size:15px;"></label>
            
      <div class="flex-container">
          <textarea readonly rows="4" cols="80" class="fill-width" id="mailtext" 
          style ="
          border-top: none;
          border-right: none;
          border-left: none;
          padding-left:25px;
          padding-top:5px;
          font-family:fira;
          color:#2b2b2b;
          font-size: 18px;
          background-color:white" ></textarea>
      </div>
      </div>';


    echo '<div class="rightb"><br>

          <div id="trainMenu" style="display:none;"><br><br>
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
                <td><input type="button" id="mailintent" class="intentdisp" value=""></td>
                <td>Sentiment</td>
                <td><input type="button" id="mailsentiment" class="intentdisp" value=""></td>
                </tr>
              <tr>
                <td>Intent Score</td>
                <td><input type="button" id="mailintentscore" class="intentdisp" value=""></td>
                <td>Sentiment Score</td>
                <td><input type="button" id="mailsentimentscore" class="intentdisp" value=""></td>
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
              <br>
            <p style="color:#044548;margin-left:15px;font-family: \'fira\';">Ofcourse it is, our model is flawless!</p>
            </center>
            </div>

      </div>';




    
  $maxres = mysqli_query($con,"SELECT MAX(time) FROM data;");
  $max=mysqli_fetch_array($maxres);
  echo '<textarea name="hide" style="display:none;" id="maxval">$max[0]</textarea>';
  echo '<div class="navbar">
          <h1 style="padding-top:16px;padding-left:15px;color:white;">RiO Dashboard</h1>';
  $result = mysqli_query($con,"SELECT DISTINCT intent, COUNT(*) FROM data GROUP BY intent");
  //SELECT COUNT(*) FROM data GROUP BY intent;
  //SELECT DISTINCT `intent`, COUNT(*) FROM `data` GROUP BY `intent` 
  while ($row=mysqli_fetch_array($result)) {

      if($row[0]!="None"){
      echo '<button class="block" id="'.$row[0].'" onclick="window.location.href = \'dashboard_'.$row[0].'.php\';">';
      }
      else{
      echo '<button class="block" style="background-color:#d7e8ed;" id="'.$row[0].'" onclick="window.location.href = \'dashboard_'.$row[0].'.php\';">';
      }
      
      echo '<label  class="intent" >'.$row[0].'</label>';
      
      echo '<input type="button" class="count" value="'.$row[1].'">';

      echo '</button>'; 
  }

  echo '</div><br><br><br><br><br><br>';
?>



<body>
