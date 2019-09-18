<?php
$photoDir="photos/";
$photoTypesAllowed=["image/jpeg","image/png"];
//juhusliku foto kasutamine
$photoList=[];
//$photoList=["tlu_terra_600x400_1.jpg", "tlu_terra_600x400_2.jpg", "tlu_terra_600x400_3.jpg"];//array ehk massiiv
//var_dump($photoList);
$photoCount=count($photoList);
$allFiles= array_slice(scandir($photoDir),2);
foreach($allFiles as $file){$fileInfo=getimagesize($photoDir .$file);

//var_dump($fileinfo);
if (in_array($fileInfo["mime"], $photoTypesAllowed)==true);
{
array_push($photoList,$file);
}
}
$photoNum=mt_rand(0, $photoCount -1);
$randomImgHTML= "";
if ($photoCount > 0){
$photoNum=mt_rand(0, $photoCount -1);
$randomImgHTML= '<img src="'.$photoDir .$photoList[$photoNum] .'" alt="Juhuslik foto">';
} else {
$randomImgHTML= "<p>Kahjuks pilte pole!</p>";
}
require("header.php");
?>


<?php
echo $randomImgHTML;
?>
