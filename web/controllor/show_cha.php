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
$gno = $_POST ["goodsno"];
$sql = "SELECT Gnoplan, Gnoadopt, CHAmoney, CHAplanstate, CHAplancredit, CHAadoptstate, CHAadoptcredit, CHAtimestamp
		FROM CHA 
		WHERE 
		Gnoplan = $gno OR 
		Gnoadopt = $gno
		ORDER BY 
		CHAtimestamp DESC";
$result = $conn -> query ($sql);
if (mysqli_num_rows ($result)) {
	$row = $result -> fetch_assoc();
	$json = array ("status" => "y");
	if ($row ["Gnoplan"] == $gno) {
		$json ["money"] = $row ["CHAmoney"];
		$json ["state"] = $row ["CHAplanstate"];
		$json ["credit"] = $row ["CHAplancredit"];
		$json ["timestamp"] = $row ["CHAtimestamp"];
	}
	else {
		$json ["money"] = -$row ["CHAmoney"];
		$json ["state"] = $row ["CHAadoptstate"];
		$json ["credit"] = $row ["CHAadoptcredit"];
		$json ["timestamp"] = $row ["CHAtimestamp"];
	}	
	$conn -> close ();			
	echo json_encode ($json);
}
else {
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
}
?>