<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "myDB";
$conn = new mysqli ($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
	$json = array ("state" => "n");
	echo json_encode ($json);
}
$name = "\"" . $_GET ["username"] . "\""; 
$password = "\"" . $_GET ["password"] . "\"";
$sql = "SELECT U1.Uname, Sno, Usexy, Ucredit, Uaddress, Upassword, Uphone, Uemail 
		FROM U1, U2, U3 
		WHERE 
		Uname = $name AND Upassword = $password;";
$result = $conn -> query ($sql);
if (mysqli_num_rows ($result)) {
	$row = $result -> fetch_assoc ();
	$json = array ("state" => "y");
	$json ["uname"] = $row ["Uname"];
	$json ["sno"] = $row ["Sno"];
	$json ["usexy"] = $row ["Usexy"];
	$json ["ucredit"] = $row ["Ucredit"];
	$json ["uaddress"] = $row ["Uaddress"];
	$json ["upassword"] = $row ["Upassword"];
	$json ["uphone"] = $row ["Uphone"];
	$json ["uemail"] = $row ["Uemail"];
	$conn -> close ();
	echo json_encode ($json);
}
else {
	$sql = "SELECT * 
			FROM A 
			WHERE 
			Ano = $name AND Apassword = $password;";
	if (mysqli_num_rows ($result)) {
		$row = $result -> fetch_assoc ();
		$json = array ("state" => "y");
		$json ["ano"] = $row ["Ano"];
		$json ["aname"] = $row ["Aname"];
		$json ["apassword"] = $row ["Apassword"];
		$json ["asexy"] = $row ["Asexy"];
		$json ["aphone"] = $row ["Aphone"];
		$json ["aemail"] = $row ["Aemail"];
		$conn -> close ();
		echo json_encode ($json);
	}
	else {
		$json = array ("state" => "n");
		$conn -> close ();
		echo json_encode ($json);
	}
}
?>