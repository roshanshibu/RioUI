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
  height: 495px;
  width: 30%;
  position: fixed;
  
  bottom: 0;
  overflow-x: hidden;
}

.left {
  left: 0;
  background-color: red;
}

.right {
  width: 70%;
  right: 0;
  background-color: green;
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



</style>
</head>
<body>
<div class="split left"></div>
<div class="split right"></div>
<?php 

define('DB_HOST', 'localhost');
define('DB_NAME', 'rio');
define('DB_USER','root');
define('DB_PASSWORD','');

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD);

mysqli_query($con,"USE ".DB_NAME);
    
  $maxres = mysqli_query($con,"SELECT MAX(time) FROM data ;");
  $max=mysqli_fetch_array($maxres);
  echo '<textarea name="hide" style="display:none;" id="maxval">$max[0]</textarea>';
  echo '<div class="navbar">
          <h1 style="padding-top:16px;padding-left:15px;color:white;">RiO Dashboard</h1>';
  $result = mysqli_query($con,"SELECT DISTINCT intent, COUNT(*) FROM data GROUP BY intent");
  //SELECT COUNT(*) FROM data GROUP BY intent;
  //SELECT DISTINCT `intent`, COUNT(*) FROM `data` GROUP BY `intent` 
  while ($row=mysqli_fetch_array($result)) {

      echo '<button class="block" id="'.$row[0].'" onclick="window.location.href = \'dashboard_'.$row[0].'.php\';">';
    
      echo '<label  class="intent" >'.$row[0].'</label>';

     echo '<input type="button" class="count" value="'.$row[1].'">';

      echo '</button>'; 
  }

  echo '</div><br><br><br><br><br><br>';

?>



<body>
