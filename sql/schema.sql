DROP SCHEMA IF EXISTS kataoka;
CREATE SCHEMA kataoka;
USE kataoka;

/*
 * User table
 * Holds the information for user accounts.
 * TODO: passwords
 */
CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(24) NOT NULL,
	email VARCHAR(64) NOT NULL,
	pw VARCHAR(128) NOT NULL,
	PRIMARY KEY(id)
);

/*
 * Ruleset table
 * Holds information on predefined and custom rulesets.
 * Each game is associated with one ruleset which places constraints
 * on what data can be entered. For example, a game played under a sanma
 * ruleset will only contain data for three players.
 * TODO: rule data
 */
CREATE TABLE rulesets (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(64),
	owner_id INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(owner_id) REFERENCES users(id)
);

/*
 * Game table
 * Holds information pertaining to individual games, such as the ruleset
 * and the date the game was played.
 */
CREATE TABLE games (
	id INT NOT NULL AUTO_INCREMENT,
	rules_id INT NOT NULL,
	date DATETIME NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(rules_id) REFERENCES rulesets(id)
);

/*
 * Player table
 * A 'player' is a user participating in a game.
 * As such, the table joins the user and game tables.
 * Precalculated final score and placement are stored for efficiency.
 */
CREATE TABLE players (
	user_id INT NOT NULL,
	game_id INT NOT NULL,
	starting_seat INT NOT NULL,
	placement INT NOT NULL,
	score INT NOT NULL,
	FOREIGN KEY(user_id) REFERENCES users(id),
	FOREIGN KEY(game_id) REFERENCES games(id)
);

/*
 * Hand table
 * Holds information on a single mahjong hand.
 * TODO: hand data
 */
CREATE TABLE hands (
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY(user_id) REFERENCES users(id)
);

/*
 * Round table
 * A 'round' is a user's action during a given round in a game.
 * As such, the table joins the user and game tables.
 * Each in-game round has n rows, where n is the number of players
 * participating in the game as per the ruleset.
 * Action represents a win, a loss, an abortive draw, or no action.
 * Multiple ron is possible through multiple 'play in' actions.
 * Optionally, the player's hand for the round can be stored.
 */
CREATE TABLE rounds (
	user_id INT NOT NULL,
	game_id INT NOT NULL,
	major_round INT NOT NULL,
	minor_round INT NOT NULL,
	action INT NOT NULL,
	points INT,
	hand_id INT NULL,
	FOREIGN KEY(user_id) REFERENCES users(id),
	FOREIGN KEY(game_id) REFERENCES games(id),
	FOREIGN KEY(hand_id) REFERENCES hands(id)
);
