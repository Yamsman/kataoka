<?php
/*
 * Model class for denoting a user's participation in a game
 */
class Player {
	public $user_id;	//The user's ID
	public $seat;		//Which seat the user started as (East->north, 0->3)
	public $placement;	//Player's final placement
	public $score;		//Player's final score

	//Constuctor
	function __construct($user_id, $seat, $place, $score) {
		$this->user_id = $user_id;
		$this->seat = $seat;
		$this->placement = $place;
		$this->score = $score;
	}
}

/*
 * Model class for a single game record
 */
class Game {
	public $id;		//The game's ID
	public $rules_id;	//The ID of the associated ruleset
	public $date;		//The date the game was played
	public $players;	//Array of players participating in the game

	//Constructor
	function __construct($id, $rules_id, $date) {
		$this->id = $id;
		$this->rules_id = $rules_id;
		$this->date = $date;
		$this->players = array();
	}

	function add_player($id, $seat, $place, $score) {
		$pl = new Player($id, $seat, $place, $score);
		array_push($this->players, $pl);
	}
}
?>
