<?php
function readAllFilms(){
//var_dump($GLOBALS);
    $conn=new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
$stmt = $conn->prepare("SELECT pealkiri FROM film");
echo $conn->error;
$stmt->bind_result($filmTitle);
$stmt->execute();
echo $stmt->error;
$filmInfoHTML=null;
while($stmt->fetch())
{
//echo $filmTitle;
$filmInfoHTML .= "<h3>" .$filmTitle ."</h3>";


}

//sulgeme ühendused
$stmt->close();
$conn->close();
return $filmInfoHTML;
}

function storeFilmInfo($filmTitle,$filmYear,$filmDuration,
$filmGenre,$filmStudio,$filmDirector)
{
    $conn=new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("INSERT INTO film (pealkiri,aasta,kestus,zanr,tootja,lavastaja) VALUES(?,?,?,?,?,?)");
//$stmt->bind_param("siisss");
echo $conn->error;
//seon saadetava info muutujatega
          //andmetüübid: s - string, i - integer, d - decimal
          $stmt->bind_param("siisss", $filmTitle, $filmYear, $filmDuration, $filmGenre, $filmStudio, $filmDirector);
          $stmt->execute();
          
          $stmt->close();
          $conn->close();
  }

?>