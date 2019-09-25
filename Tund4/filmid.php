<?php
require("../config_vp2019.php");
include("../header.php");
$database="if19_inga_pe_4";
require("function_film.php");
$filmInfoHTML=readAllFilms();
?>
<hr>
  <h2>Eesti filmid</h2>
  <p>Meie andmebaasis leiduvad järgmised filmid:</p>
  <hr>
<?php
    echo $filmInfoHTML;

?>