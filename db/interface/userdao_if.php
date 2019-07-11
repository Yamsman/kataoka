<?php
interface UserDAOInterface {
	public static function create($conn, User &$user);
	public static function update($conn, User $user);
	public static function get_by_id($conn, $id);
	public static function get_by_name($conn, $name);
}
?>
