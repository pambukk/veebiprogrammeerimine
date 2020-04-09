<?php
  require("../../config_eesrakendused.php");
  require("functions_main.php");
  require("function_lisa.php");
 
  $loodud= date("Y-m-d");
  $kategooria = ["tavaline", "madal", "kõrge", "tänaseks"];
  $error="";
  $notice = null;
  $latestTodosHTML = latestTodos();
  
  if(isset($_POST["submitMessage"])){
  if(strlen($_POST["tiitel"]) == 0){
    $error .= "Pealkiri on puudu!";
                  }
  if(strlen($_POST["sisu"]) == 0){
    $error .= "Sisu on puudu! ";
                  }
  if($_POST["loodud"] >= $loodud){
      $loodud = $_POST["loodud"];
                  }
                  
  $tiitel = test_input($_POST["tiitel"]);
  $sisu = test_input($_POST["sisu"]);
    if($error == ""){
                          
  $result = storeMessage($tiitel, $sisu, $loodud);
    if($result == 1){
    $notice = "Uudis salvestatud!";
    $error = "";
    $tiitel = "";
    $sisu = "";
    $loodud = date("Y-m-d");
        }
      }
  }
?>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu ülesanded</label><br>
	  <textarea rows="2" cols="51" name="tiitel" id="tiitel" placeholder="Lisa ülesaned nimetus ..."></textarea>
	  <br>
    <label>Ülesande sisu</label><br>
          <textarea rows="5" cols="51" name="sisu" id="sisu" placeholder="Lisa ülesande sisu ..."></textarea>
          <br>
<label>Ülesande täitmise kuupäev</label><br>
<input type="date" id="loodud" name="loodud" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $loodud; ?>">
<label>Kategooria: </label>
<?php
            echo '<select name="kategooria">' ."\n";
               # echo '<option value="" selected disabled>kategooria</option>' ."\n";
                for ($i = 0; $i < 4; $i ++){
                        echo '<option value="' .$i .'"';
                        if ($i == $kategooria){
                                echo " selected ";
                        }
                        echo ">" .$kategooria[$i] ."</option> \n";
                }
                echo "</select> \n";
          ?>



	  <input name="submitMessage" type="submit" value="Salvesta sõnum"><span><?php echo $notice; ?></span>
	</form>
	<hr>
	<h2>Senised sõnumid</h2>
	<?php
	  echo $latestTodosHTML;
	?>
  
</body>
</html>

