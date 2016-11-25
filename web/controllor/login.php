<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "BDB";
$conn = new mysqli ($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
	$json = array ("status" => "n1");
	echo json_encode ($json);
	exit;
}
$uname = "\"" . $_POST ["uname"] . "\""; 
$upassword = "\"" . $_POST ["upassword"] . "\"";
$sql = "SELECT User_1.Uname, Sno, Uroot, Usexy, Ucredit, Uaddress, Upassword, Uphone, Uemail 
		FROM User_1, User_2, User_3 
		WHERE 
		User_1.Uname = User_2.Uname AND
		User_1.Uname = User_3.Uname AND
		User_1.Uname = $uname AND 
		Upassword = $upassword;";
$result = $conn -> query ($sql);
if ($result && mysqli_num_rows ($result)) {
	$row = $result -> fetch_assoc ();
	if(!$row['Uname']||!$row ["Sno"]){
		$json = array ("status" => "n2");
		$conn -> close ();
		echo json_encode ($json);
		exit;
	}
	else 
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
	$json = array ("status" => "n3");
	$conn -> close ();
	echo json_encode ($json);
	exit;
}
?>