




<?php
  require("../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_punkel";

  //kontrollime, kas on sisse loginud
  if(!isset($_SESSION["userId"])){
    header("Location: myindex.php");
    exit();
}

 //väljalogimine
 if(isset($_GET["logout"])){
  session_destroy();
  header("Location: myindex.php");
  exit();
}

  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  $userName = null;
  
  require("../header.php");

  echo "<h1>" .$_SESSION["userFirstname"] .", veebiprogrammeerimine 2019</h1>";
  ?>
  <p>Suvaline leht!</p>
  <hr>
  <p>Olete sisseloginud!</p>

  <p><a href="?logout=1">Logi välja!</a></p>

</body>
</html>