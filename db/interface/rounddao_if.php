<?php
interface RoundDAOInterface {
	public static function create($conn, Round &$round);
	public static function update($conn, Round $round);
	public static function delete($conn, Round $round);
}
?>
