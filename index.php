<?php
require_once 'db-auth.php';
require_once 'header.php';

require_once 'db/userdao.php';
$conn = new mysqli($db_ip, $db_uname, $db_pw, $db_schema);

$testusr = new User(0, "Kirishima", "kirishima@gmail.com", 'foobaz');
UserDAO::create($conn, $testusr);

$res = $conn->query("SELECT * FROM users;");

for ($i = 0; $i < $res->num_rows; $i++) {
	$res->data_seek($i);
	$row = $res->fetch_assoc();
	echo "Row $i:<br>";
	echo "*    ID: " . $row["id"] . "<br>";
	echo "*    Name: " . $row["name"] . "<br>";
	echo "*    Email: " . $row["email"] . "<br>";
	echo "*    Pass: " . $row["pw"] . "<br>";
	echo "<br>";
}

$conn->close();
require 'footer.php';
?>
