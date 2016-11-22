<?php
$conn = new mysqli ('127.0.0.1', 'root', '');
if ($conn -> connect_error) 
    die('Connect Error (' . $conn -> connect_errno . ')' . $conn -> connect_error . '<br>');
echo 'Connection OK' . '<br>';
$sql = "CREATE DATABASE BDB;";
if ($conn -> query ($sql) === TRUE) 
    echo "数据库创建成功..." . '<br>';
else 
    echo "Error creating database: " . $conn->error . '<br>';
$conn -> close();
?>
