<?php
interface RulesetDAOInterface {
	public static function create($conn, Ruleset &$rset);
	public static function update($conn, Ruleset $rset);
	public static function get($conn, $id);
	public static function delete($conn, Ruleset $rset);
}
?>
