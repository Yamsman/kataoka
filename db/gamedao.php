<?php
require_once 'model/game.php';
require_once 'interface/gamedao_if.php';

class GameDAO implements GameDAOInterface {
	/*
	 * Inserts a new game record into the database
	 * The game will have no rounds associated with it when initially created
	 */
	public static function create($conn, Game &$game) {
		//Insert the game's record
		$query = $conn->prepare('INSERT INTO games (rules_id, date) VALUES (?, ?);');
		$query->bind_param("is", $game->rules_id, $game->date);
		$res = $query->execute();
		echo $conn->error;
		if ($res == false) return false;
		$game->id = $conn->insert_id;

		//Insert all associated player records
		for ($i = 0; $i < count($game->players); $i++) {
			//Get the player
			$pl = $game->players[$i];
			
			//Create and execute the query
			$query = $conn->prepare('INSERT INTO players
				(user_id, game_id, starting_seat, placement, score)
				VALUES (?, ?, ?, ?, ?);');
			$query->bind_param("iiiii",
				$pl->user_id, $game->id,
				$pl->seat, $pl->placement, $pl->score
			);
			$res = $query->execute();
			if (!$res) return false;
		}
		return true;
	}

	/*
	 * Updates a game record and all of its dependant entities
	 */
	public static function update($conn, Game $game) {
		//Update the game record
		$query = $conn->prepare('UPDATE games SET date = ? WHERE id = ?;');
		$query->bind_param("si", $game->date, $game->id);
		$res = $query->execute();
		if ($res == false) return false;

		//Update all associated player records
		for ($i = 0; $i < count($game->players); $i++) {
			//Get the player
			$pl = $game->players[$i];
			
			//Create and execute the query
			$query = $conn->prepare('UPDATE players SET
				starting_seat = ?, placement = ?, score = ?
				WHERE user_id = ? AND game_id = ?;');
			$query->bind_param("iiiii",
				$pl->seat, $pl->placement, $pl->score,
				$pl->user_id, $game->game_id
			);
			$res = $query->execute();
			echo $conn->error;
			if (!$res) return false;
		}

		return true;
	}

	/*
	 * Retrieves a game record by ID
	 */
	public static function get($conn, $id) {
		//Query the main game record
		$query = $conn->prepare('SELECT * FROM games WHERE id = ?;');
		$query->bind_param("i", $game->id);
		if ($query->execute() == false) return null;

		//Create the game object
		$res = $query->get_result();
		$row = $res->fetch_assoc();
		$game = new Game($row['id'], $row['rules_id'], $row['date']);

		//Query the player records
		$query = $conn->prepare('SELECT * FROM players WHERE game_id = ?;');
		$query->bind_param("i", $game->id);
		if ($query->execute() == false) return null;

		//Add the player record data to the game object
		$res = $query->get_result();
		for ($i = 0; $i < $res->num_rows; $i++) {
			$res->data_seek($i);
			$row = $res->fetch_assoc();

			$pl = new Player($row['user_id'], $row['starting_seat'], 
				$row['placement'], $row['score']);
			array_push($game->players, $pl);
		}
		return $game;
	}

	/*
	 * Deletes a game record and all of its dependant entities
	 */
	public static function delete($conn, Game $game) {
		//Update all associated player records
		for ($i = 0; $i < count($game->players); $i++) {
			//Get the player
			$pl = $game->players[$i];
			
			//Create and execute the query
			$query = $conn->prepare('DELETE FROM players WHERE user_id = ? AND game_id = ?;');
			$query->bind_param("ii", $pl->user_id, $game->game_id);
			$res = $query->execute();
			echo $conn->error;
			if (!$res) return false;
		}

		//Update the game record
		$query = $conn->prepare('DELETE FROM games WHERE game_id = ?;');
		$query->bind_param("i", $game->id);
		$res = $query->execute();
		if ($res == false) return false;

		return true;
	}
}
?>
