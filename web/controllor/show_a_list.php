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
$sql = "SELECT User_1.Uname, Uroot, Usexy, Ucredit, Uaddress
		FROM User_1, User_2
		WHERE 
		User_1.Uname = User_2.Uname;";
$result = $conn -> query ($sql);
if ($result && mysqli_num_rows ($result)) {
	$json = array ("status" => "y");
	$i = 0;
	while ($row = $result -> fetch_assoc()) {
		$jsonn = array ();
		$jsonn ["uname"] = $row ["Uname"];
		$jsonn ["usexy"] = $row ["Usexy"];
		$jsonn ["ucredit"] = $row ["Ucredit"];
		$jsonn ["uaddress"] = $row ["Uaddress"];
		$json [++$i] = $jsonn;
	}
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
else {
	$conn -> close ();
	$json = array ("status" => "n");	
	echo json_encode ($json);
	exit;
}
?>