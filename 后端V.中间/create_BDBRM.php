<?php
$servername = "127.0.0.1";
$username = "root";
$password = "160013";
$dbname = "BDB";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
     die("连接失败: " . $conn->connect_error . '<br>');
} 

// 使用 sql 创建S数据表
$sql = "CREATE TABLE S (
Sno CHAR(8) PRIMARY KEY, 
Spassword VARCHAR(12) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table S created successfully".'<br>';
} else {
    echo "创建数据表S错误: " . $conn->error . '<br>';
}

// 使用 sql 创建U1数据表
$sql = "CREATE TABLE U1 (
Uname VARCHAR(40) PRIMARY KEY, 
Sno CHAR(8) UNIQUE NOT NULL,
FOREIGN KEY (Sno) REFERENCES S(Sno)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table U1 created successfully".'<br>';
} else {
    echo "创建数据表U1错误: " . $conn->error . '<br>';
}

// 使用 sql 创建U2数据表
$sql = "CREATE TABLE U2 (
Uname VARCHAR(40) PRIMARY KEY, 
Usexy INT NOT NULL,
Ucredit INT NOT NULL,
Uaddress VARCHAR(40) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table U2 created successfully".'<br>';
} else {
    echo "创建数据表U2错误: " . $conn->error . '<br>';
}

// 使用 sql 创建U3数据表
$sql = "CREATE TABLE U3 (
Uname VARCHAR(40) PRIMARY KEY, 
Upassword VARCHAR(12) NOT NULL,
Uphone CHAR(11),
Uemail VARCHAR(40)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table U3 created successfully".'<br>';
} else {
    echo "创建数据表U3错误: " . $conn->error . '<br>';
}

// 使用 sql 创建C数据表
$sql = "CREATE TABLE C (
Clevel INT PRIMARY KEY, 
Cleft INT UNIQUE NOT NULL,
Cright INT UNIQUE NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table C created successfully".'<br>';
} else {
    echo "创建数据表C错误: " . $conn->error . '<br>';
}

// 使用 sql 创建A数据表
$sql = "CREATE TABLE A (
Ano CHAR(8) PRIMARY KEY,
Aname VARCHAR(40) NOT NULL, 
Apassword VARCHAR(12) NOT NULL,
Asexy INT NOT NULL,
Aphone CHAR(11) UNIQUE NOT NULL,
Aemail VARCHAR(40) UNIQUE NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table A created successfully".'<br>';
} else {
    echo "创建数据表A错误: " . $conn->error . '<br>';
}

// 使用 sql 创建R数据表
$sql = "CREATE TABLE R (
Rno INT PRIMARY KEY, 
Rcontent VARCHAR(200) UNIQUE NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table R created successfully".'<br>';
} else {
    echo "创建数据表R错误: " . $conn->error . '<br>';
}

// 使用 sql 创建G1数据表
$sql = "CREATE TABLE G1 (
Gno INT PRIMARY KEY, 
Gname VARCHAR(40) NOT NULL,
Uname VARCHAR(40) NOT NULL,
Gtype VARCHAR(40) NOT NULL,
Gaddress VARCHAR(40) NOT NULL,
Gstate INT NOT NULL,
FOREIGN KEY (Uname) REFERENCES U1(Uname)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table G1 created successfully".'<br>';
} else {
    echo "创建数据表G1错误: " . $conn->error . '<br>';
}

// 使用 sql 创建G2数据表
$sql = "CREATE TABLE G2 (
Gno INT PRIMARY KEY,
Gcheck INT NOT NULL,
Gtimestamp TIMESTAMP NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table G2 created successfully".'<br>';
} else {
    echo "创建数据表G2错误: " . $conn->error . '<br>';
}

// 使用 sql 创建G3数据表
$sql = "CREATE TABLE G3 (
Gno INT PRIMARY KEY, 
Ginstruction VARCHAR(400),
Gparameter VARCHAR(400),
Gtime INT NOT NULL,
Gprice INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table G3 created successfully".'<br>';
} else {
    echo "创建数据表G3错误: " . $conn->error . '<br>';
}

// 使用 sql 创建T数据表
$sql = "CREATE TABLE T (
Tno INT PRIMARY KEY, 
Tcontent VARCHAR(40) UNIQUE NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table T created successfully".'<br>';
} else {
    echo "创建数据表T错误: " . $conn->error . '<br>';
}

// 使用 sql 创建I数据表
$sql = "CREATE TABLE I ( 
Iaddress VARCHAR(40) PRIMARY KEY,
Gno INT NOT NULL,
FOREIGN KEY (Gno) REFERENCES G1(Gno)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table I created successfully".'<br>';
} else {
    echo "创建数据表I错误: " . $conn->error . '<br>';
}

// 使用 sql 创建M数据表
$sql = "CREATE TABLE M (
Mno INT PRIMARY KEY, 
Mcontent VARCHAR(400) NOT NULL,
Mtimestamp TIMESTAMP NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table M created successfully".'<br>';
} else {
    echo "创建数据表M错误: " . $conn->error . '<br>';
}

// 使用 sql 创建UAR数据表
$sql = "CREATE TABLE UAR (
UA INT, 
Rno INT,
PRIMARY KEY (UA, Rno),
FOREIGN KEY (Rno) REFERENCES R(Rno)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table UAR created successfully".'<br>';
} else {
    echo "创建数据表UAR错误: " . $conn->error . '<br>';
}

// 使用 sql 创建DES数据表
$sql = "CREATE TABLE DES (
Gno INT, 
Tno INT,
PRIMARY KEY (Gno, Tno),
FOREIGN KEY (Gno) REFERENCES G1(Gno),
FOREIGN KEY (Tno) REFERENCES T(Tno)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table DES created successfully".'<br>';
} else {
    echo "创建数据表DES错误: " . $conn->error . '<br>';
}

// 使用 sql 创建BRO数据表
$sql = "CREATE TABLE BRO (
Uname VARCHAR(40), 
Gno INT,
BROtimestamp TIMESTAMP NOT NULL,
PRIMARY KEY (Uname, Gno),
FOREIGN KEY (Uname) REFERENCES U1(Uname),
FOREIGN KEY (Gno) REFERENCES G1(Gno)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table BRO created successfully".'<br>';
} else {
    echo "创建数据表BRO错误: " . $conn->error . '<br>';
}

// 使用 sql 创建PLA数据表
$sql = "CREATE TABLE PLA (
Gnoplan INT, 
Gnoadopt INT,
PLAmoney INT NOT NULL,
PLAtimestamp TIMESTAMP NOT NULL,
PRIMARY KEY (Gnoplan, Gnoadopt),
FOREIGN KEY (Gnoplan) REFERENCES G1(Gno),
FOREIGN KEY (Gnoadopt) REFERENCES G1(Gno)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table PLA created successfully".'<br>';
} else {
    echo "创建数据表PLA错误: " . $conn->error . '<br>';
}

// 使用 sql 创建CHA数据表
$sql = "CREATE TABLE CHA (
Gnoplan INT PRIMARY KEY, 
Gnoadopt INT UNIQUE NOT NULL,
CHAmoney INT NOT NULL,
CHAplanstate INT NOT NULL,
CHAplancredit INT NOT NULL,
CHAadoptstate INT NOT NULL,
CHAadoptcredit INT NOT NULL,
CHAtimestamp TIMESTAMP NOT NULL,
FOREIGN KEY (Gnoadopt) REFERENCES G1(Gno)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table CHA created successfully".'<br>';
} else {
    echo "创建数据表CHA错误: " . $conn->error . '<br>';
}

// 使用 sql 创建COM数据表
$sql = "CREATE TABLE COM (
Mno INT PRIMARY KEY, 
Gnoplan INT UNIQUE NOT NULL, 
Gnoadopt INT UNIQUE NOT NULL,
FOREIGN KEY (Gnoplan) REFERENCES G1(Gno),
FOREIGN KEY (Gnoadopt) REFERENCES G1(Gno)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table COM created successfully".'<br>';
} else {
    echo "创建数据表COM错误: " . $conn->error . '<br>';
}

// 使用 sql 创建NTI数据表
$sql = "CREATE TABLE NTI (
Mno INT PRIMARY KEY, 
Uname VARCHAR(40) NOT NULL,
Dic INT NOT NULL,
FOREIGN KEY (Uname) REFERENCES U1(Uname)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table NTI created successfully".'<br>';
} else {
    echo "创建数据表NTI错误: " . $conn->error . '<br>';
}

$conn->close();

 ?> 