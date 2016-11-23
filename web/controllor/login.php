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
$upassword = "\"" . $_POST ["upassword"] . "\"";
$sql = "SELECT U1.Uname, Sno, Uroot, Usexy, Ucredit, Uaddress, Upassword, Uphone, Uemail 
		FROM U1, U2, U3 
		WHERE 
		U1.Uname = U2.Uname AND
		U1.Uname = U3.Uname AND
		U1.Uname = $uname AND 
		Upassword = $upassword;";
$result = $conn -> query ($sql);
if ($result && mysqli_num_rows ($result)) {
	$row = $result -> fetch_assoc ();
	$json = array ("status" => "y");
	$json ["uname"] = $row ["Uname"];
	$json ["sno"] = $row ["Sno"];
	$json ["uroot"] = $row ["Uroot"];
	$json ["usexy"] = $row ["Usexy"];
	$json ["ucredit"] = $row ["Ucredit"];
	$json ["uaddress"] = $row ["Uaddress"];
	$json ["upassword"] = $row ["Upassword"];
	$json ["uphone"] = $row ["Uphone"];
	$json ["uemail"] = $row ["Uemail"];
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