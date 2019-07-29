<?php
interface GameDAOInterface {
	public static function create($conn, Game &$game);
	public static function update($conn, Game $game);
	public static function get($conn, $id);
	public static function delete($conn, Game $game);
}
?>

