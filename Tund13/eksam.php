<?php
  require("../config_vp2019.php");
  require("functions_main.php");
  require("functions_news.php");
  $database = "if19_punkel";
  require("classes/Picupload.class.php");
  require("functions_user.php");
  #require("functions_pic.php");

  
  #$userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  $notice = null;
  $error = "";
  $newsTitle = "";
  $news = "";
  $expiredate = date("Y-m-d");
  $fileSizeLimit = 2500000;
	$maxPicW = 600;
	$maxPicH = 400;
	$fileNamePrefix = "vp_";
	$waterMarkFile = "../vp_pics/vp_logo_w100_overlay.png";
	$waterMarkLocation = mt_rand(1,4); //1- ülal vasakul, 2 - ülal paremal, 3 - all paremal, 4 - all vasakul, 5 - keskel
	$waterMarkFromEdge = 10;
	$thumbW = 100;
	$thumbH = 100;
  
  //kas vajutati mõtte salvestamise nuppu
	if(isset($_POST["newsBtn"])){
		//var_dump($_POST);
		if(strlen($_POST["newsTitle"]) == 0){
			$error .= "Uudise pealkiri on puudu!";
		}
		if(strlen($_POST["newsEditor"]) == 0){
			$error .= "Uudise sisu on puudu! ";
		}
		if($_POST["expiredate"] >= $expiredate){
			//echo "TULEVIKUS";
			$expiredate = $_POST["expiredate"];
		}
		
		$newsTitle = test_input($_POST["newsTitle"]);
		$news = test_input($_POST["newsEditor"]);
		if($error == ""){
			/*$notice = "Uudis salvestatud!";
			$error = $notice;
			echo $_POST["expiredate"];*/
			$result = saveNews($newsTitle, $news, $expiredate, $fileToUpload);
			if($result == 1){
				$notice = "Uudis salvestatud!";
				$error = "";
				$newsTitle = "";
				$news = "";
				$expiredate = date("Y-m-d");
			}
		}
	
  
	

	
	  
	  #// Check if image file is a actual image or fake image
	  #if(isset($_POST["submitPic"]) and !empty($_FILES["fileToUpload"]["name"])) {
		  
		  //kasutame klassi (saadame kogu info üleslaetava faili kohta ja faili mahu piiri
		  $myPic = new Picupload($_FILES["fileToUpload"], $fileSizeLimit);
		  if($myPic->error == null){
			  //loome failinime
			  $myPic->createFileName($fileNamePrefix);
			  //teeme pildi väiksemaks
			  $myPic->resizeImage($maxPicW, $maxPicH);
			  //lisame vesimärgi
			  $myPic->addWatermark($waterMarkFile, $waterMarkLocation, $waterMarkFromEdge);
			  //kirjutame vähendatud pildi faili
			  $notice .= $myPic->savePicFile($pic_upload_dir_w600 .$myPic->fileName);
			  //thumbnail
			  $myPic->resizeImage($thumbW, $thumbH);
			  $myPic->savePicFile($pic_upload_dir_thumb .$myPic->fileName);
			  //salvestan originaali
			  $notice .= " " .$myPic->saveOriginal($pic_upload_dir_orig .$myPic->fileName);
						  
			  //salvestan info andmebaasi
			  #$notice .= addPicData($myPic->fileName, test_input($_POST["altText"]));
		  } else {
			  //1 - pole pildifail, 2 - liiga suur, pole lubatud tüüp
			  if($myPic->error == 1){
				  $notice = "Üleslaadimiseks valitud fail pole pilt!";
			  }
			  if($myPic->error == 2){
				  $notice = "Üleslaadimiseks valitud fail on liiga suure failimahuga!";
			  }
			  if($myPic->error == 3){
				  $notice = "Üleslaadimiseks valitud fail pole lubatud tüüpi (lubatakse vaid jpg, png ja gif)!";
			  }
		  }
		  unset($myPic);
	  }//kas nuppu klikiti
	  
	//<script type="text/javascript" src="javascript/checkFileSize.js" defer></script>
	#$toScript = "\t" .'<script type="text/javascript" src="javascript/checkFileSize.js" defer></script>' ."\n"; 
	#require("header.php");


  $toScript = "\t" .'<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>' ."\n";
  $toScript .= "\t" .'<script>tinymce.init({selector:"textarea#newsEditor", plugins: "link", menubar: "edit",});</script>' ."\n";
  require("header.php");
?>
<body>
 
  <h2>Lisa uudis</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
		<label>Uudise pealkiri:</label><br><input type="text" name="newsTitle" id="newsTitle" style="width: 100%;" value="<?php echo $newsTitle; ?>"><br>
		<label>Uudise sisu:</label><br>
		<textarea name="newsEditor" id="newsEditor"><?php echo $news; ?></textarea>
		<br>
		<label>Uudis nähtav kuni (kaasaarvatud)</label>
		<input type="date" name="expiredate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $expiredate; ?>">
	  <label>Vali pilt</label><br>
	  <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $fileToUpload; ?>">
	  <br>
	  <label>Alt tekst: </label><input type="text" name="altText">
	  


	  <input name="newsBtn" id="newsBtn" type="submit" value="Salvesta uudis!"> <span>&nbsp;</span><span><?php echo $error; ?></span>
	</form>
	
	
	
	
	
	
  <hr>
</body>
</html>
  








