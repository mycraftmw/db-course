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
$uname = "\"" . $_POST ["username"] . "\"";	
$sql = "SELECT Mcontent, Mtimestamp, Uname, Dic
		FROM M, NTI 
		WHERE
		M.Mno = NTI.Mno AND
		Uname = $uname
		ORDER BY Mtimestamp DESC;";
$result = $conn -> query ($sql);
$json = array ("status" => "y");
$i = 0;
while ($row = $result -> fetch_assoc()) {
		$jsonn = array ();
		$jsonn ["message"] = $row ["Mcontent"];
		$jsonn ["timestamp"] = $row ["Mtimestamp"];
		$jsonn ["name"] = $row ["Uname"];
		$jsonn ["dic"] = $row ["Dic"];
		$json [++$i] = $jsonn;
}
$conn -> close ();			
echo json_encode ($json);
?>