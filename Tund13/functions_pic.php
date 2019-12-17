<?php
function addPicData($fileName, $altText, $privacy){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpphotos2 (userid, filename, alttext, privacy) VALUES (?, ?, ?, ?)");
	echo $conn->error;
	$stmt->bind_param("issi", $_SESSION["userId"], $fileName, $altText, $privacy);
	if($stmt->execute()){
		$notice = " Pildi andmed salvestati andmebaasi!";
	} else {
		$notice = " Pildi andmete salvestamine ebaönnestus tehnilistel põhjustel! " .$stmt->error;
	}
	$stmt->close();
	$conn->close();
	return $notice;
}

function showThumbsPic($privacy, $page, $limit){
	$conn2 = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt2 = $conn2->prepare("SELECT vpphotos2.id, users.firstname, users.lastname, vpphotos2.filename, vpphotos2.alttext, AVG(vpphotoratings.rating) as AvgValue FROM vpphotos2 JOIN users ON vpphotos2.userid = users.id LEFT JOIN vpphotoratings ON vpphotoratings.photoid = vpphotos2.id WHERE vpphotos2.privacy <= ? AND deleted IS NULL GROUP BY vpphotos2.id DESC LIMIT ?, ?");
	$picHTML = null;
	$skip = ($page - 1) * $limit;
	echo $conn2->error;
	$stmt2->bind_param("iii", $privacy, $skip, $limit);
	$stmt2->bind_result($vpphotoID, $nameFromDB, $lastnameFromDB, $fileNameFromDb, $altTextFromDb, $ratings_FromDB );
	$stmt2->execute();
	while($stmt2->fetch()){
		$picHTML .= '<div class="thumbGallery"><img src="' .$GLOBALS["pic_upload_dir_thumb"] .$fileNameFromDb .'" alt="';
		if(empty($altTextFromDb)){
			$picHTML .= "Illustreeriv foto";
		} else {
			$picHTML .= $altTextFromDb;
		}
		$picHTML .= '"data-fn="' .$fileNameFromDb .'">' ."\n";
		$picHTML .= '<p>' .$nameFromDB .$lastnameFromDB .'</p>';
		if(empty($ratings_FromDB)){
		$picHTML .= '<p id="' .$vpphotoID .'">Pilt hindmata</p></div>';
	} else {
		$picHTML .= '<p id="' .$vpphotoID .'">Hinne:' .number_format((float)$ratings_FromDB, 2, '.', '') .'</p></div>';}}
	if($picHTML == null){
		$picHTML = "<p>Kahjuks pilte ei leitud!</p>";
	}
	
	$stmt2->close();
	$conn2->close();
	return $picHTML;

}



function showPics($privacy, $page, $limit){
	$picHTML = null;
	$skip = ($page - 1) * $limit;
	
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	//$stmt = $conn->prepare("SELECT filename, alttext FROM vpphotos2 WHERE privacy<=? AND deleted IS NULL");
	$stmt = $conn->prepare("SELECT filename, alttext FROM vpphotos2 WHERE privacy<=? AND deleted IS NULL ORDER BY id DESC LIMIT ?,?");
	echo $conn->error;
	$stmt->bind_param("iii", $privacy, $skip, $limit);
	$stmt->bind_result($fileNameFromDb, $altTextFromDb);
	$stmt->execute();
	while($stmt->fetch()){
		//<img src="kataloog/pildifail" alt="tekst" data-fn="pildifail">
		$picHTML .= '<img src="' .$GLOBALS["pic_upload_dir_thumb"] .$fileNameFromDb .'" alt="';
		if(empty($altTextFromDb)){
			$picHTML .= "Illustreeriv foto";
		} else {
			$picHTML .= $altTextFromDb;
		}
		$picHTML .= '" data-fn="' .$fileNameFromDb .'">' ."\n";
	}
	if($picHTML == null){
		$picHTML = "<p>Kahjuks pilte ei leitud!</p>";
	}
	
	$stmt->close();
	$conn->close();
	return $picHTML;
}

function countPics($privacy){
	$picCount;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT COUNT(id) FROM vpphotos2 WHERE privacy<=? AND deleted IS NULL");
	echo $conn->error;
	$stmt->bind_param("i", $privacy);
	$stmt->bind_result($countFromDb);
	$stmt->execute();
	$stmt->fetch();
	$picCount = $countFromDb;
	$stmt->close();
	$conn->close();
	return $picCount;
}
	












