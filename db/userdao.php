<?php
require_once 'model/user.php';
require_once 'interface/userdao_if.php';
class UserDAO implements UserDAOInterface {
	//Inserts a new user into the database
	//The user object's ID will be updated with the generated ID
	public static function create($conn, User &$user) {
		$query = $conn->prepare('INSERT INTO users (name, email, pw) VALUES (?, ?, ?);');
		$query->bind_param("sss", $user->name, $user->email, $user->pw);
		$query->execute();
		$user->id = $conn->insert_id;
	}

	//Updates a user in the database
	public static function update($conn, User $user) {
		$query = $conn->prepare('UPDATE users SET name = ?, email = ?, pw = ? WHERE id = ?;');
		$query->bind_param("sss", $user->name, $user->email, $user->pw);
		$query->execute();
	}

	//Retrieves a user by ID
	public static function get_by_id($conn, $id) {
		$query = $conn->prepare('SELECT * FROM users WHERE id = ?;');
		$query->bind_param("i", $user->id);
		$query->execute();
		$res = $query->get_result();

		//Create the object from the retrieved data
		$row = $res->fetch_assoc();
		$user = new User($row['id'], $row['name'], $row['email'], $row['pw']);
		return $user;
	}

	//Retrieves a user by name
	public static function get_by_name($conn, $name) {
		$query = $conn->prepare('SELECT * FROM users WHERE name = ?;');
		$query->bind_param("s", $user->name);
		$query->execute();
		$res = $query->get_result();

		//Create the object from the retrieved data
		$row = $res->fetch_assoc();
		$user = new User($row['id'], $row['name'], $row['email'], $row['pw']);
		return $user;
	}
}
?>
