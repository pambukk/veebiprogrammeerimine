<?php

$error = "";
$newsheadline = "";
$newsbody = "";
$expired_date = date("Y-m-d");
require("../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_punkel";
require("classes/Session.class.php");
SessionManager::Sessionstart("vp_punkel", 0, "/~punkel/", "localhost");
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


//Javascript osa:

?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>tinymce.init({selector:"textarea#newsheadline", plugins: "link", menubar: "edit",});</script>



<h2>Lisa uudis</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Uudise pealkiri:</label><br><input type="text" name="newsheadline" id="newsheadline" style="width: 100%;" value="<?php echo $newsheadline; ?>"><br>
		<label>Uudise sisu:</label><br>
		<textarea name="newsbody" id="newsbody"><?php echo $newsbody; ?></textarea>
		<br>
		<label>Uudis nähtav kuni (kaasaarvatud)</label>
		<input type="date" name="expired_date" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $expired_date; ?>">
		
		<input name="lisauudis" id="lisauudis" type="submit" value="Salvesta uudis!"> <span>&nbsp;</span><span><?php echo $error; ?></span>
	</form>
	<?
//Kui lasete uudise läbi test_input funktsiooni, siis html "<" ja ">" muudetakse koodideks. Uudise näitamisel siis tuleb need tagasi muuta ja selleks on vaja andmetabelist loetud uudis lasta läbi php funktsiooni htmlspecialchars_decode()
?>