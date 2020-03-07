<?php
  require("../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  require("functions_pic.php");
  //require("classes/Test.class.php");
  require("Picupload.class.php");
  $database = "if19_punkel";
  
  //kui pole sisseloginud
  if(!isset($_SESSION["userId"])){
	  //siis jõuga sisselogimise lehele
	  header("Location: myindex.php");
	  exit();
  }
  
  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: myindex.php");
	  exit();
  }
  
  //$myTest = new Test(123);
  //echo " Teada: " .$myTest->knownNumber;
  //echo " Teadmata: " .$myTest->secretNumber;
  //$myTest->addNumbers();
  //$myTest->multiplyNumbers();
  //unset($myTest);
  //echo " Teada: " .$myTest->knownNumber;
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
$newsTitle = "";
$news = "";
  $expiredate = date("Y-m-d");
  $notice = null;
  //var_dump($_POST);
  //var_dump($_FILES);
  
    //$target_dir = "uploads/";
	$uploadOk = 1;
	$maxPicW = 600;
	$maxPicH = 400;
	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submitPic"])) {
		$fileName = "vp_";
		$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
		$timeStamp = microtime(1) * 10000;
		$fileName .= $timeStamp ."." .$imageFileType;
		$target_file = $pic_upload_dir_orig . $fileName;
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
		
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 2500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			
			//kasutan klassi
			$myPic = new Picupload($_FILES["fileToUpload"]["tmp_name"], $imageFileType);
			//muudan pildi suurust
			$myPic->resizeImage($maxPicW, $maxPicH);
			//lisan vesimärgi
			$myPic->addWatermark("vp_pics/vp_logo_w100_overlay.png");
			//salvestame vähendatud kujutise faili
			$notice = $myPic->saveImage($pic_upload_dir_w600 .$fileName);unset($myPic);			
			
			//kopeerime originaalfaili
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
			
			//salvestan info andmebaasi
			$notice .= addPicData($fileName, test_input($_POST["altText"]), $_POST["newsEditor"], $_POST["newsTitle"]);
		}
	
	}//kas vajutati nuppu
	
    
  require("header.php");
?>
<body>
  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	  <label>Vali pilt</label><br>
	  <input type="file" name="fileToUpload" id="fileToUpload">
	  <br>
	  <label>Alt tekst: </label><input type="text" name="altText">
	  <br>
	  <label>Privaatsus</label>
	  <br>
	  <input type="radio" name="privacy" value="1"><label>Avalik</label>&nbsp;
	  <input type="radio" name="privacy" value="2"><label>Sisseloginud kasutajatele</label>&nbsp;
	  <input type="radio" name="privacy" value="3" checked><label>Isiklik</label>
<br>
                <label>Uudise pealkiri:</label><br>

<input type="text" name="newsTitle" id="newsTitle" style="width: 100%;" value="<?php echo $newsTitle; ?>"><br>
                <label>Uudise sisu:</label><br>
                <textarea name="newsEditor" id="newsEditor"><?php echo $news; ?></textarea>
                <br>
                <label>Uudis nähtav kuni (kaasaarvatud)</label>
                <input type="date" name="expiredate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $expiredate; ?>">




      <br>
	  <input name="submitPic" type="submit" value="Salvesta uudis"><span><?php echo $notice; ?></span>
	</form>
	<hr>
	  
</body>
</html>





