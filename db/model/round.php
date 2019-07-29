<?php
/*
 * Model class for an action taken by a player during a round
 */
class RoundAction {
	/*
	 * Action enumerations
	 */
	const NASHI	= 0;	//Player took no action
	const RON	= 1;	//Player called ron
	const TSUMO	= 2;	//Player called tsumo
	const FURIKOMU	= 3;	//Player played into a hand
	const USHINAU	= 4;	//Player gave up points to a tsumo
	const NOTEN	= 5;	//Player was noten at ryuukyoku
	const TENPAI	= 6;	//Player was tenpai at ryuukyoku
	const KYUUSHUU	= 7;	//Player called kyuushuu kyuuhai
	const SUUFON	= 8;	//Round was aborted by suufon renda
	const SUUCHARII	= 9;	//Round was aborted by suucha riichi
	const SUUKAIKAN	= 10;	//Round was aborted by suukaikan
	const SANCHAHOU = 11;	//Round was aborted by sanchahou
	const CHONBO	= 12;	//Player made a rules violation

	/*
	 * Member variables
	 */
	public $action;		//The action taken
	public $user_id;	//The user involved in the action
	public $hand_id;	//The user's hand for this action
	public $points;		//The amount of points won or lost

	//Constructor
	function __construct($action, $user_id, $hand_id, $points) {
		$this->action = $action;
		$this->user_id = $user_id;
		$this->hand_id = $hand_id;
		$this->points = $points;
	}
}

/*
 * Model class for a single round of a game
 * Holds n round actions, where n = number of players
 */
class Round {
	/*
	 * Major round enumerations
	 */
	const EAST_ONE  = 0;  const EAST_TWO  = 1;  const EAST_THREE  = 2;  const EAST_FOUR  = 3;
	const SOUTH_ONE = 4;  const SOUTH_TWO = 5;  const SOUTH_THREE = 6;  const SOUTH_FOUR = 7;
	const WEST_ONE  = 8;  const WEST_TWO  = 9;  const WEST_THREE  = 10; const WEST_FOUR  = 11;
	const NORTH_ONE = 12; const NORTH_TWO = 13; const NORTH_THREE = 14; const NORTH_FOUR = 15;

	/*
	 * Member variables
	 */
	public $game_id;	//The game this round belongs to
	public $major_round;	//The major round (0-3 east, 4-7 south, ...)
	public $minor_round;	//The minor round (0 base, increases with renchan)
	public $actions;	//An array of actions that occured during the round

	//Constructor
	function __construct($game_id, $maj_round, $min_round) {
		$this->game_id = $game_id;
		$this->major_round = $maj_round;
		$this->minor_round = $min_round;
		$this->actions = array();
	}

	//Adds an action to the array
	function add_action($action, $user_id, $hand_id, $points) {
		$action = new RoundAction($action, $user_id, $hand_id, $points);
		array_push($this->actions, $action);
	}
}
?>
