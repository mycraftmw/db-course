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
$state = "\"" . $_POST ["state"] . "\"";	
$credit = $_POST ["credit"];
$sql = "UPDATE Charge SET CHAplanstate = $state, CHAplancredit = $credit, CHAtimestamp = CURRENT_TIMESTAMP WHERE Gnoplan = $gno;";
$conn -> query ($sql);
$sql = "UPDATE Charge SET CHAadoptstate = $state, CHAadoptcredit = $credit, CHAtimestamp = CURRENT_TIMESTAMP WHERE Gnoadopt = $gno;";	
$conn -> query ($sql);
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$conn -> close ();			
echo json_encode ($json);
exit;
?>