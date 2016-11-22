<?php
$servername = "127.0.0.1";
$username = "root";
$password = "160013";
$dbname = "myDB";
$conn = new mysqli ($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
	$json = array ("state" => "n");
	echo json_encode ($json);
}
$name = "\"" . $_GET [0] . "\""; 
$password = "\"" . $_GET [1] . "\"";
$sql = "SELECT U1.Uname, Sno, Usexy, Ucredit, Uaddress, Upassword, Uphone, Uemail 
		FROM U1, U2, U3 
		WHERE 
		Uname = $name AND Upassword = $password;";
$result = $conn -> query ($sql);
if (mysqli_num_rows ($result)) {
	$row = $result -> fetch_assoc ();
	$_COOKIE ["uname"] = $row ["Uname"];
	$_COOKIE ["sno"] = $row ["Sno"];
	$_COOKIE ["usexy"] = $row ["Usexy"];
	$_COOKIE ["ucredit"] = $row ["Ucredit"];
	$_COOKIE ["uaddress"] = $row ["Uaddress"];
	$_COOKIE ["upassword"] = $row ["Upassword"];
	$_COOKIE ["uphone"] = $row ["Uphone"];
	$_COOKIE ["uemail"] = $row ["Uemail"];
	$json = array ("state" => "y");
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
		$_COOKIE ["ano"] = $row ["Ano"];
		$_COOKIE ["aname"] = $row ["Aname"];
		$_COOKIE ["apassword"] = $row ["Apassword"];
		$_COOKIE ["asexy"] = $row ["Asexy"];
		$_COOKIE ["aphone"] = $row ["Aphone"];
		$_COOKIE ["aemail"] = $row ["Aemail"];
		$json = array ("state" => "y");
		$conn -> close ();
		return json_encode ($json);
	}
	else {
		$json = array ("state" => "n");
		$conn -> close ();
		return json_encode ($json);
	}
}
?>