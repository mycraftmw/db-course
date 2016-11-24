<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "BDB";

// 创建连接
$conn = new mysqli ($servername, $username, $password, $dbname);
// 检测连接
if ($conn -> connect_error) 
     die ("连接失败: " . $conn -> connect_error . '<br>');
	 
create Procedure User_information
@uname VARCHAR (40),
@upassword VARCHAR (40)
as
SELECT User_1.Uname, Sno, Uroot, Usexy, Ucredit, Uaddress, Upassword, Uphone, Uemail 
FROM User_1, User_2, User_3 
WHERE 
User_1.Uname = User_2.Uname AND
User_1.Uname = User_3.Uname AND
User_1.Uname = @uname AND 
Upassword = @upassword;
	 
?> 