<?php

function storeMessage($message){
$notice=null;
$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
$stmt = $conn-> prepare("insert into vpmsg (userid, message) VALUES(?,?)");
echo $conn ->error;
$stmt -> bind_param("is", $_SESSION["userId"], $message);
if($stmt-> execute()){
$notice="Sõnum salvestati!";
}else{
    $notice="Sõnumi salvestamisel tekkis tõrge: " .$stmt -> error;
}
$stmt->close();
$conn->close();
return $notice;
}

function readAllMessages(){
$notice=null;
$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
$stmt = $conn-> prepare("select message, created from vpmsg where deleted is NULL");
echo $conn ->error;
$stmt -> bind_result($messageFromDb, $createdFromDb);
$stmt -> execute();
while($stmt -> fetch()){
$notice .= "<li>" .$messageFromDb ."(Lisatud:" .$createdFromDb .")</li> \n"; 
}
if (!empty($notice)){
    $notice="<ul> \n" .$notice ."</ul> \n";
}else{
    $notice ="Kahjuks pole messe";
}

$stmt->close();
$conn->close();
return $notice;


}
function readMyMessages(){
    $notice=null;
    $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
    $stmt = $conn-> prepare("select message, created from vpmsg where  userid=? and deleted is NULL");
    echo $conn ->error;
    $stmt -> bind_param("i", $_SESSION["userId"]);    
    $stmt -> bind_result($messageFromDb, $createdFromDb);
    $stmt -> execute();
    while($stmt -> fetch()){
    $notice .= "<li>" .$messageFromDb ."(Lisatud:" .$createdFromDb .")</li> \n"; 
    }
    if (!empty($notice)){
        $notice="<ul> \n" .$notice ."</ul> \n";
    }else{
        $notice ="Kahjuks pole messe";
    }
    
    $stmt->close();
    $conn->close();
    return $notice;
    
    
    }
