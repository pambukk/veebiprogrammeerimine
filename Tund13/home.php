<?php
  require("../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_punkel";
  require("classes/Session.class.php");
  SessionManager::Sessionstart("vp_punkel", 0, "/~punkel/", "localhost");
  
  //kontrollime, kas on sisse loginud
  if(!isset($_SESSION["userId"])){
	header("Location: myindex.php");
	exit();
  }
  
  //väljalogimine
  if(isset($_GET["logout"])){
	  //sessioon kinni
	  session_unset();
	  session_destroy();
	  header("Location: myindex.php");
	  exit();
  }
  //küspsised
  setcookie("vpusername",$_SESSION["userFirstname"] ." " .$_SESSION["userLastname"],
   time()+(86400*31), "/~punkel/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]), true);
  echo count($_COOKIE);
  if(isset($_COOKIE["vpusername"])){
  echo "Leiti küpsis: " .$_COOKIE["vpusername"];}
  else {
  echo "Ei midagi";
  }

  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  require("header.php");
?>
<body>
<?php
  echo "<h1>" .$userName .", veebiprogrammeerimine 2019</h1>";
  ?>
  <p>See veebileht on valminud õppetöö käigus ning ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
  <hr>
  <p>Olete sisseloginud! Logi <a href="?logout=1">välja</a>!</p>
  <ul>
  <li><a href="uudiselisamine.php">Lisa uudis</a></li>
    <li><a href="userprofile.php">Kasutajaprofiil</a></li>
	<li><a href="messages.php">Sõnumid</a></li>
	<li><a href="showfilminfo.php">Filmid</a></li>
	<li><a href="picupload.php">Piltide üleslaadimine</a></li>
	<li><a href="gallery.php">Pildigalerii</a></li>
  </ul>

</body>
</html>
