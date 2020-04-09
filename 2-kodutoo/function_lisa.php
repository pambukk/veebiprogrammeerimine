<?php	

	function storeMessage($tiitel, $sisu, $loodud ){
		$notice = 0;

		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO todo (tiitel, sisu, loodud, todo_valmis, olek, kategooria ) values  (?, ?, ?, ?, 1, 2)");
		echo $conn->error;
		$stmt->bind_param("ssss", $tiitel, $sisu, $loodud, $loodud);
		#if($stmt->execute()){
		#	$response = 1;
		#} else {
		#	$response = 0;:q
		#	echo $stmt->error;
        #}
        
        if($stmt -> execute()){
            $notice = "Sõnum salvestati!";
    } else {
            $notice = "Sõnmi salvestamisel tekkis tehniline tõrge: " .$stmt -> error;
    }

	$stmt->close();
	#$stmt2->close();
	$conn->close();
	return $notice;
}

	function latestTodos(){
        $notice = null;
        $latesttodoHTML = null;
		#$today = date("Y-m-d");
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT tiitel, sisu, loodud FROM todo ORDER BY loodud DESC LIMIT 5");
		echo $conn->error;
		#$stmt->bind_param("i", $limit);
		$stmt->bind_result($tiitelFromDb, $sisuFromDb, $loodudFromDb);
        $stmt->execute();
        #var_dump($stmt);
		while ($stmt->fetch()){
           /* 
			$latesttodoHTML .= "<div> \n";
			$latesttodoHTML .= "\t <h3>" .$tiitelFromDb ."</h3> \n";
			$loodudTime = new DateTime($loodudFromDb);
			$latesttodoHTML .= "\t <p>(Lisatud: " .$loodudTime->format("d.m.Y H:i:s") .")</p> \n";
			$latesttodoHTML .= "\t <div>" .$sisuFromDb ."</div> \n";
            $latesttodoHTML .= "</div> \n";
            */

            
            $notice .= "<li>" .$tiitelFromDb ." Lisatud" .$sisuFromDb ." " .$loodudFromDb ."</li> \n";
            echo $tiitelFromDb .$loodudFromDb .$sisuFromDb;
            }
            if(!empty($notice)){
                $notice = "<ul> \n" .$notice ."</ul> \n";
                            }else{

                                $notice = "<p> Kahjuks Todosid pole. </p> \n";
                            }
              
		/*
		if(mysqli_num_rows($stmt)==1){
			$latesttodoHTML = "<p>Kahjuks Todo-sid pole!</p>";
          }
          */
		$stmt->close();
		$conn->close();
		#return $todoHTML;
          return $notice;
     }