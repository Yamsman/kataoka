DROP SCHEMA IF EXISTS maajan;
CREATE SCHEMA maajan;
USE maajan;

CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(24) NOT NULL,
    email VARCHAR(64) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE ruleset (
	id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(64),
    owner_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(owner_id) REFERENCES users(id)
);

CREATE TABLE game (
	id INT NOT NULL AUTO_INCREMENT,
    date DATETIME,
    rules_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(rules_id) REFERENCES ruleset(id)
);

CREATE TABLE user_game (
	user_id INT NOT NULL,
    game_id INT NOT NULL,
    starting_seat INT,
    ending_placement INT,
    ending_score FLOAT,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(game_id) REFERENCES game(id)
);

CREATE TABLE round (
	id INT NOT NULL AUTO_INCREMENT,
	game_id INT NOT NULL,
    major_round INT,
    minor_round INT,
    PRIMARY KEY(id),
    FOREIGN KEY(game_id) REFERENCES game(id)
);

CREATE TABLE player_round (
	user_id INT,
    round_id INT,
    seat INT,
    result_type INT,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(round_id) REFERENCES round(id)
);
