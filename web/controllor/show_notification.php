<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "BDB";
$conn = new mysqli ($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
	$json = array ("status" => "n");
	echo json_encode ($json);
	exit;
}
$uname = "\"" . $_POST ["uname"] . "\"";	
$sql = "SELECT Mcontent, Mtimestamp, Unamesend, Unamereceive 
		FROM Message, Notify 
		WHERE
		Message.Mno = Notify.Mno AND
		(Unamesend = $uname OR Unamereceive = $uname) 
		ORDER BY Mtimestamp DESC;";
$result = $conn -> query ($sql);
if ($result) {
	$json = array ("status" => "y");
	$i = 0;
	while ($row = $result -> fetch_assoc()) {
		$jsonn = array ();
		$jsonn ["mcontent"] = $row ["Mcontent"];
		$jsonn ["mtimestamp"] = $row ["Mtimestamp"];
		$jsonn ["unamesend"] = $row ["Unamesend"];
		$jsonn ["unamereceive"] = $row ["Unamereceive"];
		$json [++$i] = $jsonn;
	}	
	$conn -> close ();	
	echo json_encode ($json);
	exit;
}
else {
	$json = array ("status" => "n");
	$conn -> close ();	
	echo json_encode ($json);
	exit;
}
?>