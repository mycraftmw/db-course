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
// 使用 sql 创建 Student 数据表
$sql = "CREATE TABLE Student (
Sno CHAR (8) PRIMARY KEY, 
Spassword VARCHAR (40) NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
	echo "Table Student created successfully" . '<br>'; 
else 
    echo "创建数据表 Student 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 User_1 数据表
$sql = "CREATE TABLE User_1  (
Uname VARCHAR (40) PRIMARY KEY, 
Sno CHAR (8) NOT NULL,
Uroot VARCHAR (40) NOT NULL,
FOREIGN KEY (Sno) REFERENCES Student (Sno)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table User_1  created successfully" . '<br>';
else 
    echo "创建数据表 User_1  错误: " . $conn -> error . '<br>';
// 使用 sql 创建 User_2 数据表
$sql = "CREATE TABLE User_2 (
Uname VARCHAR (40) PRIMARY KEY, 
Usexy VARCHAR (40) NOT NULL,
Ucredit INT NOT NULL,
Uaddress VARCHAR (40) 
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table User_2 created successfully" . '<br>';
else 
    echo "创建数据表 User_2 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 User_3 数据表
$sql = "CREATE TABLE User_3 (
Uname VARCHAR (40) PRIMARY KEY, 
Upassword VARCHAR (40) NOT NULL,
Uphone CHAR (11) UNIQUE NOT NULL,
Uemail VARCHAR (40) UNIQUE NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table User_3 created successfully" . '<br>';
else 
    echo "创建数据表 User_3 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 Credit 数据表
$sql = "CREATE TABLE Credit (
Clevel VARCHAR (40) PRIMARY KEY, 
Cleft INT UNIQUE NOT NULL,
Cright INT UNIQUE NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table Credit created successfully" . '<br>';
else 
    echo "创建数据表 Credit 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 Root 数据表
$sql = "CREATE TABLE Root (
Rno INT PRIMARY KEY, 
Rcontent VARCHAR (40) UNIQUE NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table Root created successfully" . '<br>';
else 
    echo "创建数据表 Root 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 Goods_1 数据表
$sql = "CREATE TABLE Goods_1 (
Gno INT PRIMARY KEY, 
Gname VARCHAR (40) NOT NULL,
Uname VARCHAR (40) NOT NULL,
Gtype VARCHAR (40) NOT NULL,
Gaddress VARCHAR (40) UNIQUE NOT NULL,
Gstate VARCHAR (40) NOT NULL,
FOREIGN KEY (Uname) REFERENCES User_1 (Uname)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table Goods_1 created successfully" . '<br>';
else 
    echo "创建数据表 Goods_1 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 Goods_2 数据表
$sql = "CREATE TABLE Goods_2 (
Gno INT PRIMARY KEY,
Gcheck VARCHAR (40) NOT NULL,
Gtimestamp TIMESTAMP NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table Goods_2 created successfully" . '<br>';
else 
    echo "创建数据表 Goods_2 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 Goods_3 数据表
$sql = "CREATE TABLE Goods_3 (
Gno INT PRIMARY KEY, 
Ginstruction VARCHAR (400),
Gparameter VARCHAR (400),
Gtime INT,
Gprice INT
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table Goods_3 created successfully" . '<br>';
else 
    echo "创建数据表 Goods_3 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 Tag 数据表
$sql = "CREATE TABLE Tag (
Tno VARCHAR (40) PRIMARY KEY, 
Tcontent VARCHAR (40) UNIQUE NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table Tag created successfully" . '<br>';
else 
    echo "创建数据表 Tag 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 Message 数据表
$sql = "CREATE TABLE Message (
Mno INT PRIMARY KEY, 
Mcontent VARCHAR (400) NOT NULL,
Mtimestamp TIMESTAMP NOT NULL
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table Message created successfully" . '<br>';
else 
    echo "创建数据表 Message 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 User_Administrator_Root 数据表
$sql = "CREATE TABLE User_Administrator_Root (
Uroot VARCHAR (40), 
Rno INT,
PRIMARY KEY (Uroot, Rno),
FOREIGN KEY (Rno) REFERENCES Root (Rno)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table User_Administrator_Root created successfully" . '<br>';
else
    echo "创建数据表 User_Administrator_Root 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 Describle 数据表
$sql = "CREATE TABLE Describle (
Gno INT, 
Tno VARCHAR (40),
PRIMARY KEY (Gno, Tno),
FOREIGN KEY (Gno) REFERENCES Goods_1 (Gno),
FOREIGN KEY (Tno) REFERENCES Tag (Tno)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table Describle created successfully" . '<br>';
else 
    echo "创建数据表 Describle 错误: " . $conn -> error . '<br>';
// 使用 sql 创建 Search 数据表
$sql = "CREATE TABLE Search (
Uname VARCHAR (40), 
Gno INT,
BROtimestamp TIMESTAMP NOT NULL,
PRIMARY KEY (Uname, Gno),
FOREIGN KEY (Uname) REFERENCES User_1 (Uname),
FOREIGN KEY (Gno) REFERENCES Goods_1 (Gno)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table Search created successfully" . '<br>';
else 
    echo "创建数据表 Search 错误: " . $conn -> error . '<br>';
// 使用 sql 创建Charge数据表
$sql = "CREATE TABLE Charge (
Gnoplan INT PRIMARY KEY, 
Gnoadopt INT UNIQUE NOT NULL,
CHAmoney INT NOT NULL,
CHAplanstate VARCHAR (40) NOT NULL,
CHAplancredit INT NOT NULL,
CHAadoptstate VARCHAR (40) NOT NULL,
CHAadoptcredit INT NOT NULL,
CHAtimestamp TIMESTAMP NOT NULL,
FOREIGN KEY (Gnoplan) REFERENCES Goods_1 (Gno),
FOREIGN KEY (Gnoadopt) REFERENCES Goods_1 (Gno)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table Charge created successfully" . '<br>';
else 
    echo "创建数据表 Charge 错误: " . $conn -> error . '<br>';
// 使用 sql 创建Notify数据表
$sql = "CREATE TABLE Notify (
Mno INT PRIMARY KEY, 
Unamesend VARCHAR (40) NOT NULL,
Unamereceive VARCHAR (40) NOT NULL,
FOREIGN KEY (Unamesend) REFERENCES User_1 (Uname),
FOREIGN KEY (Unamereceive) REFERENCES User_1 (Uname)
)";
if ($conn -> query ($sql) === TRUE) 
    echo "Table Notify created successfully" . '<br>';
else
    echo "创建数据表 Notify 错误: " . $conn -> error . '<br>';
$conn->close();
 ?> 