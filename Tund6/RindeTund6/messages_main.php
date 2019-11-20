<?php

function storeMessage($message){
$notice=null;
$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
$stmt = $conn -> prepare("insert into vpmsg (userid, message) VALUES(?,?)");
echo $conn ->error;
$stmt -> bind_param("is", $_SESSION["userid"], $message);
if($stmt-> execute()){
$notice="Sõnum salvestati!";
}else{
    $notice="Sõnumi salvestamisel tekkis tõrge: " .$stmt -> error;
}
$stmt->close();
$conn->close();
return $notice;
}