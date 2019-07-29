<?php
require_once 'model/user.php';
require_once 'interface/userdao_if.php';

class UserDAO implements UserDAOInterface {
	//Inserts a new user into the database
	//The user object's ID will be updated with the generated ID
	//Returns false if the query fails
	public static function create($conn, User &$user) {
		$query = $conn->prepare('INSERT INTO users (name, email, pw) VALUES (?, ?, ?);');
		$query->bind_param("sss", $user->name, $user->email, $user->pw);
		$res = $query->execute();
		if ($res == false) return false;
		$user->id = $conn->insert_id;
		return true;
	}

	//Updates a user in the database
	public static function update($conn, User $user) {
		$query = $conn->prepare('UPDATE users SET name = ?, email = ?, pw = ? WHERE id = ?;');
		$query->bind_param("sssi", $user->name, $user->email, $user->pw, $user->id);
		return $query->execute();
	}

	//Retrieves a user by ID
	//Returns null if the retrieve fails
	public static function get_by_id($conn, $id) {
		$query = $conn->prepare('SELECT * FROM users WHERE id = ?;');
		$query->bind_param("i", $user->id);
		if ($query->execute() == false) return null;

		//Create the object from the retrieved data
		$res = $query->get_result();
		$row = $res->fetch_assoc();
		$user = new User($row['id'], $row['name'], $row['email'], $row['pw']);
		return $user;
	}

	//Retrieves a user by name
	//Returns null if the retrieve fails
	public static function get_by_name($conn, $name) {
		$query = $conn->prepare('SELECT * FROM users WHERE name = ?;');
		$query->bind_param("s", $user->name);
		if ($query->execute() == false) return null;

		//Create the object from the retrieved data
		$res = $query->get_result();
		$row = $res->fetch_assoc();
		$user = new User($row['id'], $row['name'], $row['email'], $row['pw']);
		return $user;
	}

	//Deletes a user from the database
	public static function delete($conn, User $user) {
		$query = $conn->prepare('DELETE FROM users WHERE id = ?;');
		$query->bind_param("i", $user->id);
		return $query->execute();
	}
}
?>
