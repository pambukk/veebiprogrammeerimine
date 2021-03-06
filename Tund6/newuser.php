<?php
  require("functions_main.php");
  require("../config_vp2019.php");
  require("functions_user.php");
  $database = "if19_punkel";
  
  $notice = null;
  $name = null;
  $surname = null;
  $email = null;
  $gender = null;
  $birthMonth = null;
  $birthYear = null;
  $birthDay = null;
  $birthDate = null;
  $monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni","juuli", "august", "september", "oktoober", "november", "detsember"];
$txtcolor_select= ["must","kollan","roheline","sinine","valge"];
$userPic = null;
$txtcolor = null;
$bgcolor = null;
$description = null;
  
  //muutujad võimalike veateadetega
  $nameError = null;
  $surnameError = null;
  $birthMonthError = null;
  $birthYearError = null;
  $birthDayError = null;
  $birthDateError = null;
  $genderError = null;
  $emailError = null;
  $passwordError = null;
  $confirmpasswordError = null;
$userPicError = null;
$txtcolorError = null;
$bgcolorError = null;
$descriptionError = null;
  
  //kui on uue kasutaja loomise nuppu vajutatud
  if(isset($_POST["submitUserData"])){

 if(isset($_POST["description"]) and !empty($_POST["description"])){
                $description = test_input($_POST["description"]);
        } else {
                $descriptionError = "Palun sisesta kirjeldus!";
        }
 if(isset($_POST["bgcolor"]) and !empty($_POST["bgcolor"])){
                $bgcolor = test_input($_POST["bgcolor"]);
        } else {
                $bgcolorError = "Palun vali tausta värvus!";
        }
 if(isset($_POST["txtcolor"]) and !empty($_POST["txtcolor"])){
                $txtcolor = test_input($_POST["txtcolor"]);
        } else {
                $txtcolorError = "Palun vali teksti värvus!";
        }


	//eesnimi
	if(isset($_POST["firstName"]) and !empty($_POST["firstName"])){
		$name = test_input($_POST["firstName"]);
	} else {
		$nameError = "Palun sisesta oma eesnimi!";
	}
	
	//perekonnanimi
	if (isset($_POST["surName"]) and !empty($_POST["surName"])){
		$surname = test_input($_POST["surName"]);
	} else {
		$surnameError = "Palun sisesta perekonnanimi!";
	}
	
	//sugu
	if(isset($_POST["gender"])){
	    $gender = intval($_POST["gender"]);
	} else {
		$genderError = "Palun märgi sugu!";
	}
		
	//kuupäeva osa
	  if(isset($_POST["birthDay"]) and !empty($_POST["birthDay"])){
	  $birthDay = intval($_POST["birthDay"]);
	  } else {
		  $birthDayError = "Palun vali sünnikuupäev!";
	  }
	  
	  if(isset($_POST["birthMonth"]) and !empty($_POST["birthMonth"])){
		  $birthMonth = intval($_POST["birthMonth"]);
	  } else {
		  $birthMonthError = "Palun vali sünnikuu!";
	  }
	  
	  if(isset($_POST["birthYear"]) and !empty($_POST["birthYear"])){
		  $birthYear = intval($_POST["birthYear"]);
	  } else {
		  $birthYearError = "Palun vali sünniaasta!";
	  }
	  
	  //kontrollin, kas valitud kuupäev on valiidne ehk reaalselt olemas ja moodustan kuupäeva objekti
	  if(!empty($birthDay) and !empty($birthMonth) and !empty($birthYear)){
		if(checkdate($birthMonth, $birthDay, $birthYear)){
		  $tempDate = new DateTime($birthYear ."-" .$birthMonth ."-" .$birthDay);
		  $birthDate = $tempDate->format("Y-m-d");
		} else {
			$birthDateError = "Kahjuks pole valitud kuupäev korrektne, olemas!";
		}
	  }
	
	//email ehk kasutajatunnus
	if (isset($_POST["email"]) and !empty($_POST["email"])){
	  $email = test_input($_POST["email"]);
	} else {
	  $emailError = "Palun sisesta e-postiaadress!";
	}
	//parool ja selle kaks korda sisestamine
	if (!isset($_POST["password"]) or empty($_POST["password"])){
	  $passwordError = "Palun sisesta salasõna!";
	} else {
	  if(strlen($_POST["password"]) < 8){
	    $passwordError = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["password"]) ." märki).";
	  }
	}
	  
	if (!isset($_POST["confirmpassword"]) or empty($_POST["confirmpassword"])){
	  $confirmpasswordError = "Palun sisestage salasõna kaks korda!";  
	} else {
	  if($_POST["confirmpassword"] != $_POST["password"]){
	    $confirmpasswordError = "Sisestatud salasõnad ei olnud ühesugused!";
	  }
	}
	
	//kui kõik on olemas, korras, siis salvestame kasutaja
	if(empty($nameError) and empty($surnameError) and empty($birthMonthError) and empty($birthYearError) and empty($birthDayError) and empty($birthDateError) and empty($genderError) and empty($emailError) and empty($passwordError) and empty($confirmpasswordError)){
		$notice = signUp($name, $surname, $email, $gender, $birthDate, $_POST["password"]);
	} else {
		$notice = "Ei saa salvestada, andmed on puudulikud!";
	}
	
  }//kui on nuppu vajutatud
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<title>Uue kasutaja loomine</title>
  </head>
  <body>
    <h1>Loo endale kasutaja</h1>
	<p>Suvaline leht.</p>
	<hr>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Eesnimi:</label><br>
	  <input name="firstName" type="text" value="<?php echo $name; ?>"><span><?php echo $nameError; ?></span><br>
      <label>Perekonnanimi:</label><br>
	  <input name="surName" type="text" value="<?php echo $surname; ?>"><span><?php echo $surnameError; ?></span>
	  <br>
	  <label><input type="radio" name="gender" value="2" <?php if($gender == "2"){		echo " checked";} ?>>Naine</label>
	  <label><input type="radio" name="gender" value="1" <?php if($gender == "1"){		echo " checked";} ?>>Mees</label><br>
	  <span><?php echo $genderError; ?></span><br>
	  <br>
	  <label>Sünnipäev: </label>
	  <?php
	    echo '<select name="birthDay">' ."\n";
		echo "\t\t" .'<option value="" selected disabled>päev</option>' ."\n";
		for($i = 1; $i < 32; $i ++){
			echo "\t\t" .'<option value="' .$i .'"';
			if($i == $birthDay){
				echo " selected";
			}
		echo ">" .$i ."</option> \n";
		}
		echo "\t </select>";
	  ?>
	  <label>Sünnikuu: </label>
	  <?php
	    echo '<select name="birthMonth">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthMonth){
				echo " selected ";
			}
			echo ">" .$monthNamesET[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <label>Sünniaasta: </label>
	  <?php
	    echo '<select name="birthYear">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthYear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <br>
	  <span><?php echo $birthDateError ." " .$birthDayError ." " .$birthMonthError ." " .$birthYearError; ?></span>
	  <label>Lisa pilt:</label><br>
	  <input name="userPic" type="file" value="<?php echo $userPic; ?>"><span><?php echo $userPicError; ?></span><br>
 <label>Lisa kirjeldus:</label><br>
          <textarea rows="5"  name="description" value="<?php echo $description; ?>"></textarea><span><?php echo $descriptionError; ?></span><br>
 <label>Vali taustavärv:</label><br>
          <input name="bgcolor" type="text" value="<?php echo $bgcolor; ?>"><span><?php echo $bgcolorError; ?></span><br>
<label>Vali tekstivärv:</label><br>
 <?php
            echo '<select name="txtcolor">' ."\n";
                echo  '<option value="" selected disabled>Värv</option>' ."\n";
                for($i = 1; $i < 5; $i ++){
                        echo '<option value="' .$i .'"';
                        if($i == $txtcolor){
                                echo " selected";
                        }
                echo ">" .$txtcolor_select[$i -1] ."</option> \n";
                }
                echo " </select> \n";
          ?>


	  
	  <br>
	  <label>E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="email" value="<?php echo $email; ?>"><span><?php echo $emailError; ?></span><br>
	  <label>Salasõna (min 8 tähemärki):</label><br>
	  <input name="password" type="password"><span><?php echo $passwordError; ?></span><br>
	  <label>Korrake salasõna:</label><br>
	  <input name="confirmpassword" type="password"><span><?php echo $confirmpasswordError; ?></span><br>
	  <input name="submitUserData" type="submit" value="Loo kasutaja"><span><?php echo $notice; ?></span>
	</form>
	<hr>
		
  </body>
</html>
