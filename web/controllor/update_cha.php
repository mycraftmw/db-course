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
$state = $_POST ["state"];	
$credit = $_POST ["credit"];
$sql = "UPDATE CHA SET CHAplanstate = $state, CHAplancredit = $credit, CHAtimestamp = CURRENT_TIMESTAMP WHERE Gnoplan = $gno;";
$sql = "UPDATE CHA SET CHAadoptstate = $state, CHAadoptcredit = $credit, CHAtimestamp = CURRENT_TIMESTAMP WHERE Gnoadopt = $gno;";	
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);;
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$conn -> close ();			
echo json_encode ($json);
?>