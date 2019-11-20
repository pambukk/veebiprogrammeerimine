<?php
require("../config_vp2019.php");
//require("functions_main.php");
//require("functions_user.php");
//$database = "if19_punkel";

/*function profile($email, $password){
	$notice = "";
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
	echo $conn->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($passwordFromDb);
	if($stmt->execute()){
		//kui päring õnnestus
	  if($stmt->fetch()){
		//kasutaja on olemas
		if(password_verify($password, $passwordFromDb)){
		  //kui salasõna klapib
		  $stmt->close();
		  $stmt = $conn->prepare("SELECT id, firstname, lastname FROM users WHERE email=?");
		  echo $conn->error;
		  $stmt->bind_param("s", $email);
		  $stmt->bind_result($idFromDb, $firstnameFromDb, $lastnameFromDb);
		  $stmt->execute();
		  $stmt->fetch();
		  $notice = "Sisse logis " .$firstnameFromDb ." " .$lastnameFromDb ."!";
		  
		  //salvestame kasutaja kohta loetud info sessioonimuutujatesse
		  $_SESSION["userId"] = $idFromDb;
		  $_SESSION["userFirstname"]= $firstnameFromDb;
		  $_SESSION["userLastname"]= $lastnameFromDb;

		  //enne sisselogitutele mõeldud lehtede jõudmist sulgeme andmebaasi ühendused
		  $stmt->close();
		  $conn->close();
			  //liigume soovitud lehele
			  header("Location: home.php");
			  //et siin rohkem midagi ei tehtaks
      exit();  
        }
    }
    }
}
*/
?>


if(isset($_POST["submitUserData"])){
		//pildi valik
		if(isset($_POST["userPic"]) and !empty($_POST["userPic"])){
			$name = test_input($_POST["userPic"]);
		} else {
			$nameError = "Pilti ei ole valitud";
		}  


    <h1>Loo endale kasutajakontoprofiil</h1>
		<hr>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <label>Minu kirjeldus</label><br>
          <textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea>
          <br>
          <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
          <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
          <input name="submitProfile" type="submit" value="Salvesta profiil">
        </form>
 <hr>
	