<?php
  require("../config_vp2019.php");
  #require("functions_main.php");
  #require("functions_user.php");
  $database = "if19_punkel";
  
  require("header.php");
?>
<body>
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
