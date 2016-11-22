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
$name = "\"" . $_POST ["username"] . "\""; 
$password = "\"" . $_POST ["password"] . "\"";
$sql = "SELECT U1.Uname, Sno, Usexy, Ucredit, Uaddress, Upassword, Uphone, Uemail 
		FROM U1, U2, U3 
		WHERE 
		Uname = $name AND Upassword = $password;";
$result = $conn -> query ($sql);
if (mysqli_num_rows ($result)) {
	$row = $result -> fetch_assoc ();
	$json = array ("status" => "y");
	$json ["name"] = $row ["Uname"];
	$json ["no"] = $row ["Sno"];
	$json ["sexy"] = $row ["Usexy"];
	$json ["credit"] = $row ["Ucredit"];
	$json ["address"] = $row ["address"];
	$json ["password"] = $row ["Upassword"];
	$json ["phone"] = $row ["Uphone"];
	$json ["email"] = $row ["Uemail"];
	$conn -> close ();
	echo json_encode ($json);
}
else {
	$sql = "SELECT * 
			FROM A 
			WHERE 
			Ano = $name AND Apassword = $password;";
	$result = $conn -> query ($sql);
	if (mysqli_num_rows ($result)) {
		$row = $result -> fetch_assoc ();
		$json = array ("status" => "y");
		$json ["no"] = $row ["Ano"];
		$json ["name"] = $row ["Aname"];
		$json ["password"] = $row ["Apassword"];
		$json ["sexy"] = $row ["Asexy"];
		$json ["phone"] = $row ["Aphone"];
		$json ["email"] = $row ["Aemail"];
		$conn -> close ();
		echo json_encode ($json);
	}
	else {
		$json = array ("status" => "n");
		$conn -> close ();
		echo json_encode ($json);
	}
}
?>