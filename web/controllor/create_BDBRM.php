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
// 使用 sql 创建 S 数据表
$sql = "CREATE TABLE S (
Sno CHAR (8) PRIMARY KEY, 
Spassword VARCHAR (40) NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
	echo "Table S created successfully" . '<br>'; 
else 
    echo "创建数据表 S 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 U1 数据表
$sql = "CREATE TABLE U1 (
Uname VARCHAR (40) PRIMARY KEY, 
Sno CHAR (8) NOT NULL,
Uroot VARCHAR (40) NOT NULL,
FOREIGN KEY (Sno) REFERENCES S (Sno)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table U1 created successfully" . '<br>';
else 
    echo "创建数据表 U1 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 U2 数据表
$sql = "CREATE TABLE U2 (
Uname VARCHAR (40) PRIMARY KEY, 
Usexy VARCHAR (40) NOT NULL,
Ucredit INT NOT NULL,
Uaddress VARCHAR (40) 
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table U2 created successfully" . '<br>';
else 
    echo "创建数据表 U2 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 U3 数据表
$sql = "CREATE TABLE U3 (
Uname VARCHAR (40) PRIMARY KEY, 
Upassword VARCHAR (40) NOT NULL,
Uphone CHAR (11) UNIQUE NOT NULL,
Uemail VARCHAR (40) UNIQUE NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table U3 created successfully" . '<br>';
else 
    echo "创建数据表 U3 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 C 数据表
$sql = "CREATE TABLE C (
Clevel VARCHAR (40) PRIMARY KEY, 
Cleft INT UNIQUE NOT NULL,
Cright INT UNIQUE NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table C created successfully" . '<br>';
else 
    echo "创建数据表 C 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 R 数据表
$sql = "CREATE TABLE R (
Rno INT PRIMARY KEY, 
Rcontent VARCHAR (40) UNIQUE NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table R created successfully" . '<br>';
else 
    echo "创建数据表 R 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 G1 数据表
$sql = "CREATE TABLE G1 (
Gno INT PRIMARY KEY, 
Gname VARCHAR (40) NOT NULL,
Uname VARCHAR (40) NOT NULL,
Gtype VARCHAR (40) NOT NULL,
Gaddress VARCHAR (40) UNIQUE NOT NULL,
Gstate VARCHAR (40) NOT NULL,
FOREIGN KEY (Uname) REFERENCES U1 (Uname)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table G1 created successfully" . '<br>';
else 
    echo "创建数据表 G1 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 G2 数据表
$sql = "CREATE TABLE G2 (
Gno INT PRIMARY KEY,
Gcheck VARCHAR (40) NOT NULL,
Gtimestamp TIMESTAMP NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table G2 created successfully" . '<br>';
else 
    echo "创建数据表 G2 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 G3 数据表
$sql = "CREATE TABLE G3 (
Gno INT PRIMARY KEY, 
Ginstruction VARCHAR (400),
Gparameter VARCHAR (400),
Gtime INT,
Gprice INT
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table G3 created successfully" . '<br>';
else 
    echo "创建数据表 G3 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 T 数据表
$sql = "CREATE TABLE T (
Tno VARCHAR (40) PRIMARY KEY, 
Tcontent VARCHAR (40) UNIQUE NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table T created successfully" . '<br>';
else 
    echo "创建数据表 T 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 M 数据表
$sql = "CREATE TABLE M (
Mno INT PRIMARY KEY, 
Mcontent VARCHAR (400) NOT NULL,
Mtimestamp TIMESTAMP NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table M created successfully" . '<br>';
else 
    echo "创建数据表 M 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 UAR 数据表
$sql = "CREATE TABLE UAR (
Uroot VARCHAR (40), 
Rno INT,
PRIMARY KEY (Uroot, Rno),
FOREIGN KEY (Rno) REFERENCES R (Rno)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table UAR created successfully" . '<br>';
else
    echo "创建数据表 UAR 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 DES 数据表
$sql = "CREATE TABLE DES (
Gno INT, 
Tno VARCHAR (40),
PRIMARY KEY (Gno, Tno),
FOREIGN KEY (Gno) REFERENCES G1 (Gno),
FOREIGN KEY (Tno) REFERENCES T (Tno)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table DES created successfully" . '<br>';
else 
    echo "创建数据表 DES 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 BRO 数据表
$sql = "CREATE TABLE BRO (
Uname VARCHAR (40), 
Gno INT,
BROtimestamp TIMESTAMP NOT NULL,
PRIMARY KEY (Uname, Gno),
FOREIGN KEY (Uname) REFERENCES U1 (Uname),
FOREIGN KEY (Gno) REFERENCES G1 (Gno)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table BRO created successfully" . '<br>';
else 
    echo "创建数据表 BRO 错误: " . $conn -> error . '<br>';
// 使用 sql 创建CHA数据表
$sql = "CREATE TABLE CHA (
Gnoplan INT PRIMARY KEY, 
Gnoadopt INT UNIQUE NOT NULL,
CHAmoney INT NOT NULL,
CHAplanstate VARCHAR (40) NOT NULL,
CHAplancredit INT NOT NULL,
CHAadoptstate VARCHAR (40) NOT NULL,
CHAadoptcredit INT NOT NULL,
CHAtimestamp TIMESTAMP NOT NULL,
FOREIGN KEY (Gnoplan) REFERENCES G1 (Gno),
FOREIGN KEY (Gnoadopt) REFERENCES G1 (Gno)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table CHA created successfully" . '<br>';
else 
    echo "创建数据表 CHA 错误: " . $conn -> error . '<br>';
// 使用 sql 创建NTI数据表
$sql = "CREATE TABLE NTI (
Mno INT PRIMARY KEY, 
Unamesend VARCHAR (40) NOT NULL,
Unamereceive VARCHAR (40) NOT NULL,
FOREIGN KEY (Unamesend) REFERENCES U1 (Uname),
FOREIGN KEY (Unamereceive) REFERENCES U1 (Uname)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table NTI created successfully" . '<br>';
else
    echo "创建数据表 NTI 错误: " . $conn -> error . '<br>';
$conn->close();
 ?> 