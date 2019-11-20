<?php
  require("../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_punkel";

  //kontrollime, kas on sisse loginud
  if(!isset($_SESSION["userId"]))
  
  
  {
    header("Location: myindex.php");
    exit();
}

//profiili vaatamine
if(isset($_GET["vaata_profiili"])){
// session_destroy();
  header("Location: myindex.php");
//  exit();
}
 //väljalogimine
 if(isset($_GET["logout"])){
  session_destroy();
  header("Location: myindex.php");
  exit();
}

  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  $userName = null;
  
  

  echo "<h1>" .$_SESSION["userFirstname"] ." " .$_SESSION["userid"] .", veebiprogrammeerimine 2019</h1>";
  if (empty($_SESSION["userid"]))

  {
    
    echo '<body bgcolor="#FFFF00"> 
    <head>
    <style>

	body{
  color: #red}

</style></head>';
echo "Profiili pole";

  }
  require("../header.php");
  ?>
  <p>Suvaline leht!</p>
  <hr>
  <p>Olete sisseloginud!</p>

  <p><a href="?logout=1">Logi välja!</a></p>
  <p><a href="userprofile.php">Loo profiil</a></p>

</body>
</html>