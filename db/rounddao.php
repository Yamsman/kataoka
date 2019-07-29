<?php
require_once 'model/round.php';
require_once 'interface/rounddao_if.php';

class RoundDAO implements RoundDAOInterface {
	/*
	 * Inserts a new set of round data into the database
	 * n rows will be inserted, where n = # of players in the game
	 * Returns false if the query fails
	 */
	public static function create($conn, Round &$round) {
		//Repeat for each round action
		for ($i = 0; $i < count($round->actions); $i++) {
			//Get the round action
			$act = $round->actions[$i];

			echo var_dump($act);
			
			//Create and execute the query
			$query = $conn->prepare('INSERT INTO rounds 
				(user_id, game_id, major_round, minor_round, action, points, hand_id) 
				VALUES (?, ?, ?, ?, ?, ?, ?);');
			$query->bind_param("iiiiiii",
				$act->user_id, $round->game_id,
				$round->major_round, $round->minor_round,
				$act->action, $act->points, $act->hand_id
			);
			$res = $query->execute();
			echo $conn->error;
			if (!$res) return false;

		}
		return true;
	}

	/*
	 * Updates the data for a single round
	 * User, game, and major/minor rounds cannot be changed once set
	 */
	public static function update($conn, Round $round) {
		//Repeat for each round action
		for ($i = 0; $i < count($round->actions); $i++) {
			//Get the round action
			$act = $round->actions[i];
			
			//Create and execute the query
			$query = $conn->prepare('UPDATE rounds 
				SET action = ?, points = ?, hand_id = ?
				WHERE user_id = ?, game_id = ?, major_round = ?, minor_round = ?;');
			$query->bind_param("iiiiiii",
				$act->action, $act->points, $act->hand_id,
				$act->user_id, $round->game_id,
				$round->major_round, $round->minor_round,
			);
			$res = $query->execute();
			if (!$res) return false;

		}
		return true;
	}

	/*
	 * Deletes a set of round data from the database
	 * Hand data is not deleted alongside the round data.
	 */
	public static function delete($conn, Round $round) {
		//Repeat for each round action
		for ($i = 0; $i < count($round->actions); $i++) {
			//Get the round action
			$act = $round->actions[i];
			
			//Create and execute the query
			$query = $conn->prepare('DELETE FROM rounds
				WHERE user_id = ?, game_id = ?, major_round = ?, minor_round = ?;');
			$query->bind_param("iiii",
				$act->user_id, $round->game_id,
				$round->major_round, $round->minor_round,
			);
			$res = $query->execute();
			if (!$res) return false;

		}
		return true;
	}
}
?>

