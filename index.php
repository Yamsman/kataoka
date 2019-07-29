<?php
require_once 'db-auth.php';
require_once 'header.php';

require_once 'db/userdao.php';
require_once 'db/rsetdao.php';
require_once 'db/rounddao.php';
require_once 'db/gamedao.php';

$conn = new mysqli($db_ip, $db_uname, $db_pw, $db_schema);

//User example
$testusr = new User(-1, "aaaa", "aaaa@gmail.com", 'aaaa');
UserDAO::create($conn, $testusr);

//Ruleset example
$testrset = new Ruleset(-1, "rset", 1);
RulesetDAO::create($conn, $testrset);

//Game example
$testgame = new Game(-1, 1, null);
$testgame->add_player(1, 0, 3, 20000);
$testgame->add_player(2, 1, 1, 35000);
$testgame->add_player(3, 2, 2, 30000);
$testgame->add_player(4, 3, 4, 15000);
$res = GameDAO::create($conn, $testgame);

//Round example
$testround = new Round($testgame->id, Round::EAST_ONE, 0);
$testround->add_action(RoundAction::TSUMO, 1, null, 8000);
$testround->add_action(RoundAction::USHINAU, 2, null, 4000);
$testround->add_action(RoundAction::USHINAU, 3, null, 2000);
$testround->add_action(RoundAction::USHINAU, 4, null, 2000);
RoundDAO::create($conn, $testround);

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
