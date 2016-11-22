<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "BDB";
$conn = new mysqli ($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
	$json = array ("status" => "n");
	echo json_encode ($json);
}
$ano = "\"" . $_POST ["username"] . "\"";	
$aphone = "\"" . $_POST ["phone"] . "\"";	
$aemail = "\"" . $_POST ["email"] . "\"";
$conn -> query ("BEGIN;");
$sql = "UPDATE A SET Aphone = $aphone, Aemail = $aemail WHERE Ano = $ano;";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$conn -> close ();			
echo json_encode ($json);
?>