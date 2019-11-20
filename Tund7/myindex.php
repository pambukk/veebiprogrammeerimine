<?php
  require("../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
 // include("userprofile.php");
  $database = "if19_punkel";
  
  $userName = "Sisselogimata kasutaja";
  
  $notice = "";
  $email = "";
  $emailError = "";
  $passwordError = "";
  
  $photoDir = "../photos/";
  $photoTypesAllowed = ["image/jpeg", "image/png"];
  //juhusliku foto kasutamine
	$photoList = [];//array ehk massiiv
	$allFiles = array_slice(scandir($photoDir), 2);
	//kontrollin, kas on pildid
	foreach ($allFiles as $file){
		$fileInfo = getimagesize($photoDir .$file);
		if (in_array($fileInfo["mime"], $photoTypesAllowed) == true){
			array_push($photoList, $file);
		}
	}
	//echo $photoList[2];
	$photoCount = count($photoList);
	$randomImgHTML = "";
	if ($photoCount > 0){
	  $photoNum = mt_rand(0, $photoCount - 1);
	  //echo $photoNum;
	  //<img src="../photos/tlu_terra_600x400_1.jpg" alt="Juhuslik foto">
	  $randomImgHTML = '<img src="' .$photoDir .$photoList[$photoNum] .'" alt="Juhuslik foto">';
	} else {
		$randomImgHTML = "<p>Kahjuks pilte pole!</p>";
	}
	//sisselogimine
	  if(isset($_POST["login"])){
		if (isset($_POST["email"]) and !empty($_POST["email"])){
		  $email = test_input($_POST["email"]);
		} else {
		  $emailError = "Palun sisesta kasutajatunnusena e-posti aadress!";
		}
	  
		if (!isset($_POST["password"]) or strlen($_POST["password"]) < 8){
		  $passwordError = "Palun sisesta parool, vähemalt 8 märki!";
		}
	  
		if(empty($emailError) and empty($passwordError)){
		   $notice = signIn($email, $_POST["password"]);
		} else {
			$notice = "Ei saa sisse logida!";
		}
	  }//kas POST login

    require("../header.php");

    echo "<h1>" .$userName .", veebiprogrammeerimine 2019</h1>";
  ?>
  <p>Suvaline leht!</p>
    

  <?php
    echo $randomImgHTML;
  ?>
  <hr>

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="email" value="<?php echo $email; ?>">&nbsp;<span><?php echo $emailError; ?></span><br>
	  
	  <label>Salasõna:</label><br>
	  <input name="password" type="password">&nbsp;<span><?php echo $passwordError; ?></span><br>
	  
	  <input name="login" type="submit" value="Logi sisse">&nbsp;<span><?php echo $notice; ?>
	</form>
  <br>
  <h2>Kui pole kasutajakontot</h2>
  <p>Loo <a href="newuser.php">kasutajakonto</a>!</p>
  <hr>
  

</body>
</html>