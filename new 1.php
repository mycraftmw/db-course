<? php
$loc = "";
fuction login_U_uname () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];	$upassword = $_GET [1];
	$sql = "SELECT * 
			FROM U3 
			WHERE 
			Uname = $uname AND Upassword = $upassword;";
	$result = $conn -> query ($sql);
	if (mysqli_num_rows ($result)) {
		$conn -> close ();
		$json = array (0 => "Y");
		return json_encode ($json);
	}
	else {
		$conn -> close ();		
		$json = array (0 => "N");
		return json_encode ($json);
	}
}	

fuction login_U_sno () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}	
	$sno = $_GET [0];	$spassword = $_GET [1];
	$sql = "SELECT * 
			FROM S 
			WHERE 
			Sno = $sno AND Spassword = $spassword;";
	$result = $conn -> query ($sql);
	if (!(mysqli_num_rows ($result))) {
		$conn -> close ();		
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$sql = "SELECT Uname 
			FROM U1 
			WHERE 
			Sno = $sno;";
	$result = $conn -> query ($sql);
	if (mysqli_num_rows ($result)) {
		$row = $result -> fetch_assoc();
		$conn -> close ();		
		$json = array (0 => "Y", 1 => $row ["Uname"]);
		return json_encode ($json);
	}
	else {
		$conn -> close ();		
		$json = array (0 => "N");
		return json_encode ($json);
	}
}

fuction register_U () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$sno = $_GET [0];	$spassword = $_GET [1];	$uname = $_GET [2];	$usexy = $_GET [3];
	$sql = "SELECT * 
			FROM S 
			WHERE 
			Sno = $sno AND Spassword = $spassword;";
	$result = $conn -> query ($sql);
	if (!(mysqli_num_rows ($result))) {
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	if ($_FILES ["image"]["type"] == "image/jpeg")) {
		$uaddress = $loc . mt_rand (0, 1000000) . ".jpg";
		while (file_exists ($uaddress))
			$uaddress = $loc . mt_rand (0, 1000000) . ".jpg";
		move_uploaded_file ($_FILES ["image"]["tmp_name"], $uaddress);
	}
	else{
		$conn -> close ();		
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$upassword = $_GET [4];	$uphone = $_GET [5];	$uemail = $_GET [6];
	$conn -> query ("BEGIN;");
	$sql = "INSERT INTO U1 VALUES ($uname, $sno);";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$sql = "INSERT INTO U2 VALUES ($uname, $usexy, 60, $uaddress);";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$sql = "INSERT INTO U3 VALUES ($uname, $upassword, $uphone, $uemail);";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction show_U_inf () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];
	$sql = "SELECT Uname, Usexy, Uaddress, Clevel
			FROM U2, C
			WHERE 
			Uname = $uname AND
			Ucredit >= Cleft AND
			Ucredit <= Cright;";
	$result = $conn -> query ($sql);
	$row = $result -> fetch_assoc ();
	$conn -> close ();
	$json = array (0 => "Y", 1 => $row ["Uname"], 2 => $row ["Usexy"], 3 => $row ["Uaddress"], 4 => $row ["Clevel"]);
	return json_encode ($json);
}

fuction show_U_inf_det () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];
	$sql = "SELECT Sno, U1.Uname, Usexy, Ucredit, Uaddress, Upassword, Uphone, Uemail
			FROM U1, U2, U3
			WHERE 
			U1.name = U2.name AND
			U1.name = U3.name AND
			Uname = $uname;";
	$result = $conn -> query ($sql);
	$row = $result -> fetch_assoc ();
	$conn -> close ();
	$json = array (0 => "Y", 1 => $row ["Sno"], 2 => $row ["Uname"], 3 => $row ["Usexy"], 
				   4 => $row ["Ucredit"], 5 => $row ["Uaddress"], 6 => $row ["Upassword"],
				   7 => $row ["Uphone"], 8 => $row ["Uemail"]);
	return json_encode ($json);
}

fuction edit_U () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];	$upassword = $_GET [1];	$uphone = $_GET [2];	$uemail = $_GET [3];
	$conn -> query ("BEGIN;");
	$sql = "UPDATE U3 SET Upassword = $upassword, Uphone = $uphone, Uemail = $uemail WHERE Uname = $uname;";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction edit_U_img () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];
	if ($_FILES ["image"]["type"] == "image/jpeg")) {
		$uaddress = $loc . mt_rand (0, 1000000) . ".jpg";
		while (file_exists ($uaddress))
			$uaddress = $loc . mt_rand (0, 1000000) . ".jpg";
		move_uploaded_file ($_FILES ["image"]["tmp_name"], $uaddress);
	}
	else{
		$conn -> close ();		
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("BEGIN;");
	$sql = "UPDATE U2 SET Uaddress = $uaddress WHERE Uname = $uname;";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction add_U_goods () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$gname = $_GET [0];	$uname = $_GET [1];	$gtype = $_GET [2];
	if ($_FILES ["image"]["type"] == "image/jpeg")) {
		$gaddress = $loc . mt_rand (0, 1000000) . ".jpg";
		while (file_exists ($gaddress))
			$gaddress = $loc . mt_rand (0, 1000000) . ".jpg";
		move_uploaded_file ($_FILES ["image"]["tmp_name"], $gaddress);
	}
	else{
		$conn -> close ();		
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$ginstruction = $_GET [3];	$gparameter = $_GET [4];	$gtime= $_GET [5];	$gprice = $_GET [6];
	$sql = "SELECT Gno FROM G1 ORDER BY Gno DESC;";
	$result = $conn -> query ($sql);
	$row = $result -> fetch_assoc ();
	$gno = $row ["Gno"] + 1;
	$conn -> query ("BEGIN;");
	$sql = "INSERT INTO G1 VALUES ($gno, $gname, $uname, $gtype, $gaddress, 0);";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$sql = "INSERT INTO G3 VALUES ($gno, $ginstruction, $gparameter, $gtime, $gprice);";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction edit_U_goods () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$gno = $_GET [0];	$gname = $_GET [1];	$gtype = $_GET [2];
	$ginstruction = $_GET [3];	$gparameter = $_GET [4];	$gtime= $_GET [5];	$gprice = $_GET [6];
	$conn -> query ("BEGIN;");
	$sql = "UPDATE G1 SET Gname = $gname, Gtype = $gtype WHERE Gno = $gno;";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$sql = "UPDATE G3 SET Ginstruction = $ginstruction, Gparameter = $gparameter, Gtime = $gtime, Gprice = $gprice WHERE Gno = $gno;";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	} 	
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction edit_U_goods_img_1 () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$gno = $_GET [0];
	if ($_FILES ["image"]["type"] == "image/jpeg")) {
		$gaddress = $loc . mt_rand (0, 1000000) . ".jpg";
		while (file_exists ($gaddress))
			$gaddress = $loc . mt_rand (0, 1000000) . ".jpg";
		move_uploaded_file ($_FILES ["image"]["tmp_name"], $gaddress);
	}
	else{
		$conn -> close ();		
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("BEGIN;");
	$sql = "UPDATE G1 SET Gaddress = $gaddress WHERE Gno = $gno;";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction edit_U_goods_tag () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$kind = $_GET [0];	$gno = $_GET [1]; $tno = $_GET [2];
	$conn -> query ("BEGIN;");
	if ($kind) {
		$sql = "INSERT INTO DES VALUES ($gno, $tno);";
		if (!($conn -> query ($sql))) {
			$conn -> query ("ROLLBACK;");
			$conn -> close ();
			$json = array (0 => "N");
			return json_encode ($json);
		}
	}
	else {
		$sql = "DELETE FROM DES WHERE Gno = $gno AND Tno = $tno;";
		if (!($conn -> query ($sql))) {
			$conn -> query ("ROLLBACK;");
			$conn -> close ();
			$json = array (0 => "N");
			return json_encode ($json);
		}
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction edit_U_goods_img_2 () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$kind = $_GET [0];	$gno = $_GET [1]; 
	$conn -> query ("BEGIN;");
	if ($kind) {
		if ($_FILES ["image"]["type"] == "image/jpeg")) {
			$iaddress = $loc . mt_rand (0, 1000000) . ".jpg";
			while (file_exists ($iaddress))
				$iaddress = $loc . mt_rand (0, 1000000) . ".jpg";
			move_uploaded_file ($_FILES ["image"]["tmp_name"], $iaddress);
		} 
		else{
			$conn -> close ();		
			$json = array (0 => "N");
			return json_encode ($json);
		}
		$sql = "INSERT INTO I VALUES ($iaddress, $gno);";
		if (!($conn -> query ($sql))) {
			$conn -> query ("ROLLBACK;");
			$conn -> close ();
			$json = array (0 => "N");
			return json_encode ($json);
		}
	}
	else {
		$iaddress = $_GET [2];
		$sql = "DELETE FROM I WHERE Gno = $gno AND Iaddress = $iaddress;";
		if (!($conn -> query ($sql))) {
			$conn -> query ("ROLLBACK;");
			$conn -> close ();
			$json = array (0 => "N");
			return json_encode ($json);
		}
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction delete_U_goods () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$gno = $_GET [0];
	$conn -> query ("BEGIN;");
	$sql = "DELETE FROM G1 VALUES WHERE Gno = $gno;";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction show_U_goods () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$gno = $_GET [0];
	$sql = "SELECT G1.Gno, Gname, Uname, Gtype, Gaddress, Ginstruction, Gparameter, Gtime, Gprice 
			FROM G1, G3
			WHERE
			G1.Gno = G3.Gno AND
			G1.Gno = $gno;";
	$result = $conn -> query ($sql);
	$row = $result -> fetch_assoc();
	$json = array (0 => "Y", 1 => $row ["Gno"], 2 => $row ["Gname"], 3 => $row ["Uname"], 
				   4 => $row ["Gtype"], 5 => $row ["Gaddress"], 6 => $row ["Ginstruction"],
				   7 => $row ["Gparameter"], 8 => $row ["Gtime"], 9 => $row ["Gprice"]);
	$sql = "SELECT Iaddress FROM I WHERE Gno = $gno;";
	$result = $conn -> query ($sql);
	$i = 0;
	$json_img = array ();
	while ($row = $result -> fetch_assoc()) 
		$json_img [++$i] = $row ["Iaddress"];
	$json_img [0] = $i;
	$json [10] = $json_img;
	$sql = "SELECT Tcontent FROM DES, T WHERE DES.Tno = T.Tno AND Gno = $gno;";
	$resulti = $conn -> query ($sql);
	$i = 0;
	$json_tag = array ();
	while ($row = $result -> fetch_assoc()) 
		$json_tag [++$i] = $row ["Tcontent"];
	$json_tag [0] = $i;
	$json [11] = $json_tag;
	$conn -> close();
	return json_encode ($json);
}

fuction show_U_goods_list () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];
	$sql = "SELECT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
			FROM G1, G2
			WHERE
			G1.Gno = G2.Gno AND 
			Uname = $uname
			ORDER BY Gtimestamp DESC;";
	$result = $conn -> query ($sql);
	$i = 0;
	$json = array (0 => "Y");
	while ($row = $result -> fetch_assoc()) {
		$json [++$i] = $row ["Gno"];
		$json [++$i] = $row ["Gname"];
		$json [++$i] = $row ["Gtype"];
		$json [++$i] = $row ["Gaddress"];
		$json [++$i] = $row ["Gtimestamp"];
	}
	$conn -> close();
	return json_encode ($json);
}

fuction show_new_goods () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];
	$sql = "SELECT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
			FROM G1, G2
			WHERE
			G1.Gno = G2.Gno AND 
			Gstate = 1 AND
			Uname != $uname
			ORDER BY Gtimestamp DESC;";
	$result = $conn -> query ($sql);
	$i = 0;
	$json = array (0 => "Y");
	while ($row = $result -> fetch_assoc()) {
		$json [++$i] = $row ["Gno"];
		$json [++$i] = $row ["Gname"];
		$json [++$i] = $row ["Gtype"];
		$json [++$i] = $row ["Gaddress"];
		$json [++$i] = $row ["Gtimestamp"];
	}
	$conn -> close();
	return json_encode ($json);
}

fuction show_guess_you () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];
	$sql = "SELECT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
			FROM G1, G2
			WHERE
			G1.Gno = G2.Gno AND
			Gstate = 1 AND
			Uname != $uname AND
			G1.Gno NOT IN (SELECT Gno FROM BRO WHERE Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10) AND
			Gtype IN (SELECT Gtype FROM G1, BRO WHERE G1.Gno = BRO.Gno AND BRO.Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10)
			ORDER BY Gtimestamp DESC;";
	$result_1 = $conn -> query ($sql);
	$sql = "SELECT G1.Gno, Gname, Gtype, Gaddress
			FROM G1, G2
			WHERE
			G1.Gno = G2.Gno AND
			Gstate = 1 AND
			Uname != $uname AND
			G1.Gno NOT IN (SELECT Gno FROM BRO WHERE Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10) AND
			Gtype NOT IN (SELECT Gtype FROM G1, BRO WHERE G1.Gno = BRO.Gno AND BRO.Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10)
			ORDER BY Gtimestamp DESC;";
	$result_2 = $conn -> query ($sql);
	$i = 0;
	$json = array (0 => "Y");
	while ($row = $result_1 -> fetch_assoc()) {
		$json [++$i] = $row ["Gno"];
		$json [++$i] = $row ["Gname"];
		$json [++$i] = $row ["Gtype"];
		$json [++$i] = $row ["Gaddress"];
		$json [++$i] = $row ["Gtimestamp"];
	}
	while ($row = $result_2 -> fetch_assoc()) {
		$json [++$i] = $row ["Gno"];
		$json [++$i] = $row ["Gname"];
		$json [++$i] = $row ["Gtype"];
		$json [++$i] = $row ["Gaddress"];
		$json [++$i] = $row ["Gtimestamp"];
	}
	$conn -> close();
	return json_encode ($json);
}

fuction show_bro () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];
	$sql = "SELECT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
			FROM G1, G2
			WHERE
			G1.Gno = G2.Gno AND
			Gstate = 1 AND
			Uname != $uname AND
			G1.Gno IN (SELECT Gno FROM BRO WHERE Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10)
			ORDER BY Gtimestamp DESC;";
	$result = $conn -> query ($sql);
	$i = 0;
	$json = array (0 => "Y");
	while ($row = $result -> fetch_assoc()) {
		$json [++$i] = $row ["Gno"];
		$json [++$i] = $row ["Gname"];
		$json [++$i] = $row ["Gtype"];
		$json [++$i] = $row ["Gaddress"];
		$json [++$i] = $row ["Gtimestamp"];
	}
	$conn -> close();
	return json_encode ($json);
}

fuction show_search_goods () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];	$words = $_GET [1];	$kind = $_GET [2];
	switch ($kind) {
		case 0:
			$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
					FROM G1, G2, DES, T
					WHERE
					G1.Gno = G2.Gno AND
					G1.Gno = DES.Gno AND
					DES.Tno = T.Tno AND
					Gstate = 1 AND
					Uname != $uname AND
					(Gname = $words OR Gtype = $words OR Tcontent = $words)
					ORDER BY Gtimestamp DESC;";
			$result = $conn -> query ($sql);
			break;
		case 1:
			$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
					FROM G1, G2, DES, T, U2
					WHERE
					G1.Gno = G2.Gno AND
					G1.Gno = DES.Gno AND
					DES.Tno = T.Tno AND
					G1.Uname = U2.Uname AND
					Gstate = 1 AND
					Uname != $uname AND
					(Gname = $words OR Gtype = $words OR Tcontent = $words)
					ORDER BY Ucredit DESC, Gtimestamp DESC;";
			$result = $conn -> query ($sql);
			break;
		case 2:
			$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
					FROM G1, G2, DES, T, G3
					WHERE
					G1.Gno = G2.Gno AND
					G1.Gno = DES.Gno AND
					DES.Tno = T.Tno AND
					G1.Gno = G3.Gno AND
					Gstate = 1 AND
					Uname != $uname AND
					(Gname = $words OR Gtype = $words OR Tcontent = $words)
					ORDER BY Gprice, Gtimestamp DESC;";
			$result = $conn -> query ($sql);
			break;
		case 3:
			$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
					FROM G1, G2, DES, T, G3
					WHERE
					G1.Gno = G2.Gno AND
					G1.Gno = DES.Gno AND
					DES.Tno = T.Tno AND
					G1.Gno = G3.Gno AND
					Gstate = 1 AND
					Uname != $uname AND
					(Gname = $words OR Gtype = $words OR Tcontent = $words)
					ORDER BY Gprice DESC, Gtimestamp DESC;";
			$result = $conn -> query ($sql);
			break;
		default :
			$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
					FROM G1, G2, DES, T, G3
					WHERE
					G1.Gno = G2.Gno AND
					G1.Gno = DES.Gno AND
					DES.Tno = T.Tno AND
					G1.Gno = G3.Gno AND
					Gstate = 1 AND
					Uname != $uname AND
					(Gname = $words OR Gtype = $words OR Tcontent = $words)
					ORDER BY Gtime, Gtimestamp DESC;";
			$result = $conn -> query ($sql);
			break;
	}
	$i = 0;
	$json = array (0 => "Y");
	while ($row = $result -> fetch_assoc()) {
		$json [++$i] = $row ["Gno"];
		$json [++$i] = $row ["Gname"];
		$json [++$i] = $row ["Gtype"];
		$json [++$i] = $row ["Gaddress"];
		$json [++$i] = $row ["Gtimestamp"];
	}
	$conn -> close();
	return json_encode ($json);
}

fuction save_search_record () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];	$gno = $_GET [1];
	$conn -> query ("BEGIN;");
	$sql = "DELETE FROM BRO WHERE Uname = $uname AND Gno = $gno;";
	$sql = "INSERT INTO BRO VALUES ($uname, $gno, CURRENT_TIMESTAMP);";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction apply_pla () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$gnoplan = $_GET [0];	$gnoadopt = $_GET [1];	$plamoney = $_GET [2];
	$conn -> query ("BEGIN;");
	$sql = "DELETE FROM PLA WHERE Gnoplan = $gnoplan AND Gnoadopt = $gnoadopt;";
	$sql = "INSERT INTO PLA VALUES ($gnoplan, $gnoadopt, $plamoney, CURRENT_TIMESTAMP);";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction delete_pla () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$gnoplan = $_GET [0];	$gnoadopt = $_GET [1];
	$conn -> query ("BEGIN;");
	$sql = "DELETE FROM PLA WHERE Gnoplan = $gnoplan AND Gnoadopt = $gnoadopt;";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction show_pla_list () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];
	$sql = "SELECT Gnoplan, G1plan.Gname Gnameplan, Gnoadopt, G1adopt.Gname Gnameadopt, PLAmoney, PLAtimestamp
			FROM PLA, G1 G1plan, G1 G1adopt 
			WHERE 
			PLA.Gnoplan = G1plan.Gno AND
			PLA.Gnoadopt = G1adopt.Gno AND
			(G1plan.Uname = $uname OR G1adopt.Uname = $uname)
			ORDER BY 
			PLAtimestamp DESC";
	$result = $conn -> query ($sql);
	$i = 0;
	$json = array (0 => "Y");
	while ($row = $result -> fetch_assoc()) {
		$json [++$i] = $row ["Gnoplan"];
		$json [++$i] = $row ["Gnameplan"];
		$json [++$i] = $row ["Gnoadopt"];
		$json [++$i] = $row ["Gnameadopt"];
		$json [++$i] = $row ["PLAmoney"];
		$json [++$i] = $row ["PLAtimestamp"];
	}
	$conn -> close();
	return json_encode ($json);
}

fuction apply_cha () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$gnoplan = $_GET [0];	$gnoadopt = $_GET [1];	$chamoney = $_GET [2];
	$conn -> query ("BEGIN;");
	$sql = "INSERT INTO CHA VALUES ($gnoplan, $gnoadopt, $chamoney, 0, 0, 0, 0, CURRENT_TIMESTAMP);";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction show_cha_list () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$uname = $_GET [0];
	$sql = "SELECT Gnoplan, G1plan.Gname Gnameplan, Gnoadopt, G1adopt.Gname Gnameadopt, CHAmoney, CHAplanstate, CHAplancredit, CHAtimestamp
			FROM CHA, G1 G1plan, G1 G1adopt 
			WHERE 
			CHA.Gnoplan = G1plan.Gno AND
			CHA.Gnoadopt = G1adopt.Gno AND
			(G1plan.Uname = $uname OR G1adopt.Uname = $uname)
			ORDER BY 
			CHAtimestamp DESC";
	$result = $conn -> query ($sql);
	$i = 0;
	$json = array (0 => "Y");
	while ($row = $result_1 -> fetch_assoc()) {
		$json [++$i] = $row ["Gnoplan"];
		$json [++$i] = $row ["Gnameplan"];
		$json [++$i] = $row ["Gnoadopt"];
		$json [++$i] = $row ["Gnameadopt"];
		$json [++$i] = $row ["CHAmoney"];
		$json [++$i] = $row ["CHAplanstate"];
		$json [++$i] = $row ["CHAplancredit"];
		$json [++$i] = $row ["CHAtimestamp"];
	}
	$conn -> close();
	return json_encode ($json);	
}

fuction update_cha () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$gnoplan = $_GET [0];	$gnoadopt = $_GET [1];	$state = $_GET [2];	$credit = $_GET [3];
	$conn -> query ("BEGIN;");
	$sql = "UPDATE CHA SET CHAplanstate = $state, CHAplancredit = $credit, CHAtimestamp = CURRENT_TIMESTAMP WHERE Gnoplan = $gnoplan AND Gnoadopt = $gnoadopt;";
	$sql = "UPDATE CHA SET CHAadoptstate = $state, CHAadoptcredit = $credit, CHAtimestamp = CURRENT_TIMESTAMP WHERE Gnoplan = $gnoadopt AND Gnoadopt = $gnoplan;";
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction communicate () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$gnoplan = $_GET [0];	$gnoadopt = $_GET [1];	$mcontent = $_GET [2];
	$sql = "SELECT Mno FROM M ORDER BY Mno DESC;";
	$result = $conn -> query ($sql);
	$row = $result -> fetch_assoc ();
	$mno = $row ["Mno"] + 1;
	$conn -> query ("BEGIN;");
	$sql = "INSERT INTO M VALUES ($mno, $mcontent, CURRENT_TIMESTAMP);";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$sql = "INSERT INTO COM VALUES ($mno, $gnoplan, $gnoadopt);";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$conn -> query ("COMMIT;");
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}

fuction show_communication () {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "160013";
	$dbname = "myDB";
	$conn = new mysqli ($servername, $username, $password, $dbname);
	if ($conn -> connect_error) {
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$gnoplan = $_GET [0];	$gnoadopt = $_GET [1];	
	$sql = "SELECT Mcontent, Mtimestamp, Gnoplan, Gnoadopt
			FROM M, COM 
			WHERE
			M.Mno = COM.Mno AND
			((Gnoplan = $gnoplan AND Gnoadopt = $gnoadopt) OR
			(Gnoplan = $gnoadopt AND Gnoadopt = $gnoplan))
			ORDER BY Mtimestamp DESC;";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$conn -> close ();
		$json = array (0 => "N");
		return json_encode ($json);
	}
	$i = 0;
	$json = array (0 => "Y");
	while ($row = $result_2 -> fetch_assoc()) {
		$json [++$i] = $row ["Mcontent"];
		$json [++$i] = $row ["Mtimestamp"];
		$json [++$i] = $row ["Gnoplan"];
		$json [++$i] = $row ["Gnoadopt"];
	}
	$conn -> close ();
	$json = array (0 => "Y");
	return json_encode ($json);
}


?>