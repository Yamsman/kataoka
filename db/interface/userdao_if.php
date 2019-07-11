<?php
interface UserDAOInterface {
	public function create(User $user);
	public function update(User $user);
	public function get_by_id($id);
	public function get_by_name($name);
}
?>
