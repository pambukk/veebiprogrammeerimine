<?php
session_start();

function signUp($name, $surname, $email, $gender, $birthDate, $password){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
	$stmt2 = $conn->prepare("INSERT into userprofiles (userid,description,bgcolor,txtcolor,picture) VALUES(?,?,?,?,?)");
	echo $conn->error;
	
	//tekitame parooli räsi (hash) ehk krüpteerime
	$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
	$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	
	$stmt->bind_param("sssiss", $name, $surname, $birthDate, $gender, $email, $pwdhash);
	
	if($stmt->execute()){
		$notice = "Kasutaja salvestamine õnnestus!";
	} else {
		$notice = "Kasutaja salvestamisel tekkis tehniline tõrge: " .$stmt->error;
	}
	$userid = mysqli_insert_id($conn);
	$stmt2->bind_param("isssi", $userid, $description, $bgcolor, $txtcolor, $picture);
	 if($stmt2->execute()){
                $notice = "Kasutaja salvestamine õnnestus!";
        } else {
                $notice = "Kasutaja salvestamisel tekkis tehniline tõrge: " .$stmt->error;
        }
	
	$stmt->close();
	$stmt2->close();
	$conn->close();
	return $notice;
}

  function signIn($email, $password){
	$notice = "";
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT password FROM users WHERE email=?");
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
		  $stmt = $conn->prepare("SELECT u.id, u.firstname, u.lastname, p.userid FROM users u LEFT JOIN userprofiles p  on u.id=p.userid WHERE u.email=?");
		  echo $conn->error;
		  $stmt->bind_param("s", $email);
		  $stmt->bind_result($idFromDb, $firstnameFromDb, $lastnameFromDb, $useridFromDb);
		  $stmt->execute();
		  $stmt->fetch();
		  $notice = "Sisse logis " .$firstnameFromDb ." " .$lastnameFromDb ."!";
		  
		  
		  
		  //salvestame kasutaja kohta loetud info sessioonimuutujatesse
		  $_SESSION["userId"] = $idFromDb;
		  $_SESSION["userFirstname"]= $firstnameFromDb;
		  $_SESSION["userLastname"]= $lastnameFromDb;
		  $_SESSION["userid"]= $useridFromDb;

		  //enne sisselogitutele mõeldud lehtede jõudmist sulgeme andmebaasi ühendused
		  $stmt->close();
		  $conn->close();
			  //liigume soovitud lehele
			  header("Location: home.php");
			  //et siin rohkem midagi ei tehtaks
	  exit();                 
		} else {
		  $notice = "Vale salasõna!";
		}//kas password_verify
	  } else {
		$notice = "Sellist kasutajat (" .$email . ")(".$useridFromDb . ") ei leitud!";
		//kui sellise e-mailiga ei saanud vastet (fetch ei andnud midagi), siis pole sellist kasutajat
	  }//kas fetch õnnestus
	} else {
	  $notice = "Sisselogimisel tekkis tehniline viga!" .$stmt->error;
	  //veateade, kui execute ei õnnestunud
	}//kas execute õnnestus
	
	$stmt->close();
	$conn->close();
	return $notice;
  }//sisselogimine lõppeb
