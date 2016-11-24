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
$gno = $_POST ["gno"];
$sql = "SELECT Gnoplan, Gnoadopt, CHAmoney, CHAplanstate, CHAplancredit, CHAadoptstate, CHAadoptcredit, CHAtimestamp
		FROM Charge 
		WHERE 
		Gnoplan = $gno OR 
		Gnoadopt = $gno
		ORDER BY 
		CHAtimestamp DESC";
$result = $conn -> query ($sql);
if ($result && mysqli_num_rows ($result)) {
	$row = $result -> fetch_assoc();
	$json = array ("status" => "y");
	if ($row ["Gnoplan"] == $gno) {
		$json ["chamoney"] = $row ["CHAmoney"];
		$json ["state"] = $row ["CHAplanstate"];
		$json ["credit"] = $row ["CHAplancredit"];
		$json ["chatimestamp"] = $row ["CHAtimestamp"];
	}
	else {
		$json ["chamoney"] = -$row ["CHAmoney"];
		$json ["state"] = $row ["CHAadoptstate"];
		$json ["credit"] = $row ["CHAadoptcredit"];
		$json ["chatimestamp"] = $row ["CHAtimestamp"];
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