<?php
require 'db-auth.php';
require 'header.php';

$conn = new mysqli($db_ip, $db_uname, $db_pw, $db_schema);
$res = $conn->query("SELECT * FROM users;");

for ($i = 0; $i < $res->num_rows; $i++) {
	$res->data_seek($i);
	$row = $res->fetch_assoc();
	echo "Row $i:<br>";
	echo "*    ID: " . $row["id"] . "<br>";
	echo "*    Name: " . $row["name"] . "<br>";
	echo "*    Email: " . $row["email"] . "<br>";
	echo "<br>";
}

$conn->close();
require 'footer.php';
?>
