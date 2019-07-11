<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once 'model/user.php';
require_once 'interface/userdao_if.php';
class UserDAO implements UserDAOInterface {
	private $conn;	//Connection to the database

	//Constructor
	function __construct($conn) {
		$this->conn = $conn;
	}

	//Inserts a new user into the database
	//The user's password is expected to be hashed
	public function create(User $user) {
		$query = $this->conn->prepare('INSERT INTO users (name, email, pw) VALUES (?, ?, ?);');
		$query->bind_param("sss", $user->name, $user->email, $user->pw);
		$query->execute();
		$user->id = $this->conn->insert_id;
	}

	//Updates a user in the database
	public function update(User $user) {
		$query = $this->conn->prepare('UPDATE users SET name = ?, email = ?, pw = ? WHERE id = ?;');
		$query->bind_param("sss", $user->name, $user->email, $user->pw);
		$query->execute();
	}

	//Retrieves a user by ID
	public function get_by_id($id) {
		$query = $this->conn->prepare('SELECT * FROM users WHERE id = ?;');
		$query->bind_param("i", $user->id);
		$query->execute();
		$res = $query->get_result();

		//Create the object from the retrieved data
		$row = $res->fetch_assoc();
		$user = new User($row['id'], $row['name'], $row['email'], $row['pw']);
		return $user;
	}

	//Retrieves a user by name
	public function get_by_name($name) {
		$query = $this->conn->prepare('SELECT * FROM users WHERE name = ?;');
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
