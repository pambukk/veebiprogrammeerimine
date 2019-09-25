<?php
require("../config_vp2019.php");
include("../header.php");
$database="if19_inga_pe_4";
require("function_film.php");
//$filmInfoHTML=readAllFilms();
//var_dump($_POST);
if(isset($_POST["submitFilm"])){
    if(!empty($_POST["filmTitle"]))
    {
storeFilmInfo($_POST["filmTitle"],$_POST["filmYear"],$_POST["filmDuration"],$_POST["filmGenre"],$_POST["filmStudio"],$_POST["filmDirector"]);}
}
?>
<hr>
  <h2>Eesti filmid</h2>
  <p>Meie andmebaasi filmi lisamine:</p>
  <hr>
<form method="POST">
<label> Filmi nimi: </label>
<input type="text" name="filmTitle">
<br>
<label> Filmi aasta: </label>
<input type="number" min="1912" max="2019" value="2019" name="filmYear">
<br>
<label> Filmi pikkus (min): </label>
<input type="number" min="1" max="300" value="80" name="filmDuration">
<br>
<label> Filmi zanr: </label>
<input type="text" name=filmGenre>
<br>
<label> Filmi stuudio: </label>
<input type="text" name=filmStudio>
<br>
<label> Filmi lavastaja: </label>
<input type="text" name=filmDirector>
<br>


<input type="submit" value="Talleta filmi info" name="submitFilm">
  </form>

</body>
</html>