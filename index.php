<?php
$hourNow= date("H");
$partOfDay="Hägune aeg";
if ($hourNow >=5 && $hourNow <9){
 $partOfDay = "Hommik";
}
if ($hourNow >=9 && $hourNow <16){
 $partOfDay = "Päev";
}
if ($hourNow >=16 && $hourNow <22){
 $partOfDay = "Õhtu";
}
else {
 $partOfDay="Mingi öö";
}

?>
<DOCTYPE html>
<html lang="et">
<body>
<H2>
<?php
echo $partOfDay;
?>
