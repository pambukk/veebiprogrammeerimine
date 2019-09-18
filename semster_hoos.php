<?php
$username="Urmas ";
$semesterStart=new DateTime("2019-9-2");
$semesterEnd=new DateTime("2019-12-13");
$semesterDuration= $semesterStart -> diff($semesterEnd);
$today=new DateTime("now");
$fromSemesterStart=$semesterStart -> diff($today);
#var_dump($semesterStart);
#echo "Päevi: " .$fromSemesterStart -> format("%r%a");
#<p>Semester on täies hoos: <meter min="0" max="110" value="55">17%</meter></p>
$semesterInfoHTML="<p>Info semsteri kohta pole kättesaadav.</p>";
if ($fromSemesterStart -> format("%r%a") > 0 and $fromSemesterStart -> format("%r%a") <= $semesterDuration -> format("%r%a"))
{
$semesterInfoHTML= "<p>Semester on täies hoos: ";
$semesterInfoHTML .= "<meter min=\"0\" ";
$semesterInfoHTML .= "max=\"" .$semesterDuration -> format("%r%a")."\" ";
$semesterInfoHTML .= 'value="' .$fromSemesterStart -> format("%r%a") .'">';
$semesterInfoHTML .= round($fromSemesterStart -> format("%r%a") / $semesterDuration -> format("%r%a") * 100,1) ."%";
$semesterInfoHTML .= "</meter></p>";
} 
?>
<!DOCTYPE html>
<html lang="et">
<head>
<meta charset="utf-8">
<?php
	echo $username;
?>
programmeerib veebi</title>
</head>
<p> 
<body>
<?php 
 echo $semesterInfoHTML;
?>

