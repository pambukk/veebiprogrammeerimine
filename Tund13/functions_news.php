<?php	

	function saveNews($newsTitle, $news, $expiredate, $fileToUpload ){
		$notice = 0;

		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO news (userid, title, content, expire, filename) values  (1,?, ?, ?, ?)");
		echo $conn->error;
		$stmt->bind_param("ssss", $newsTitle, $news, $expiredate, $fileToUpload);
		if($stmt->execute()){
			$response = 1;
		} else {
			$response = 0;
			echo $stmt->error;
		}
		$stmt->close();
	#$stmt2->close();
	$conn->close();
	return $notice;
}

	function latestNews($limit){
		$newsHTML = null;
		$today = date("Y-m-d");
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT title, content, added FROM news WHERE expire >=? AND deleted IS NULL ORDER BY id DESC LIMIT ?");
		echo $conn->error;
		$stmt->bind_param("si", $today, $limit);
		$stmt->bind_result($titleFromDb, $contentFromDb, $addedFromDb);
		$stmt->execute();
		while ($stmt->fetch()){
			$newsHTML .= "<div> \n";
			$newsHTML .= "\t <h3>" .$titleFromDb ."</h3> \n";
			$addedTime = new DateTime($addedFromDb);
			$newsHTML .= "\t <p>(Lisatud: " .$addedTime->format("d.m.Y H:i:s") .")</p> \n";
			$newsHTML .= "\t <div>" .htmlspecialchars_decode($contentFromDb) ."</div> \n";
			$newsHTML .= "</div> \n";
		}
		if($newsHTML == null){
			$newsHTML = "<p>Kahjuks uudiseid pole!</p>";
		}
		$stmt->close();
		$conn->close();
		return $newsHTML;
	}