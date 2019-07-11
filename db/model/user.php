<?php
class User {
	public $id;	//The user's ID
	public $name;	//User's name
	public $email;	//User's email
	public $pw;	//Hashed password

	function __construct($id, $name, $email, $hash) {
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->pw = $hash;
	}

	public function set_pw($pw) {
		$this->pw = password_hash($pw, PASSWORD_BCRYPT);
	}
}
?>
