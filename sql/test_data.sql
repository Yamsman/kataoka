USE kataoka;

-- User data
INSERT INTO users(name, email) VALUES ('Choukai', 'choukai@gmail.com');
INSERT INTO users(name, email) VALUES ('Kongou', 'kongou@gmail.com');
INSERT INTO users(name, email) VALUES ('Mutsuki', 'mutsuki@gmail.com');
INSERT INTO users(name, email) VALUES ('Hibiki', 'hibiki@gmail.com');

-- Ruleset data
INSERT INTO rulesets(name, owner_id) VALUES ('WRC Ruleset', 1);
INSERT INTO rulesets(name, owner_id) VALUES ('Tenhou Ruleset', 2);

-- Game data
INSERT INTO games(rules_id) VALUES (1);

-- Player data
INSERT INTO players(user_id, game_id, starting_seat, placement, score)
	VALUES (1, 1, 1, 1, 30000);
INSERT INTO players(user_id, game_id, starting_seat, placement, score)
	VALUES (2, 1, 1, 4, 20000);
INSERT INTO players(user_id, game_id, starting_seat, placement, score)
	VALUES (3, 1, 1, 3, 22500);
INSERT INTO players(user_id, game_id, starting_seat, placement, score)
	VALUES (4, 1, 1, 2, 27500);

-- Hand data
-- TODO

/* 
 * Round data for game ID 1:
 * East 1:   Tsumo, player 1
 * East 2:   Ryuukyoku, players 1 & 3
 * East 3:   Oya ron, player 4, player 2
 * East 3-1: Ryuukyoku, player 2
 * East 4:   Ron, player 3, player 4
 */
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (1, 1, 1, 0, 1, 4000, NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (2, 1, 1, 0, 4, 2000, NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (3, 1, 1, 0, 4, 1000, NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (4, 1, 1, 0, 4, 1000, NULL);

INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (1, 1, 2, 0, 5, 1500, NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (2, 1, 2, 0, 6, 1500, NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (3, 1, 2, 0, 5, 1500, NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (4, 1, 2, 0, 6, 1500, NULL);

INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (1, 1, 3, 0, 0, 0,    NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (2, 1, 3, 0, 3, 5200, NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (3, 1, 3, 0, 0, 0,    NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (4, 1, 3, 0, 1, 5200, NULL);

INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (1, 1, 3, 1, 6, 1000, NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (2, 1, 3, 1, 5, 3000, NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (3, 1, 3, 1, 6, 1000, NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (4, 1, 3, 1, 6, 1000, NULL);

INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (1, 1, 4, 0, 0, 0,    NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (2, 1, 4, 0, 0, 0,    NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (3, 1, 4, 0, 1, 1300, NULL);
INSERT INTO rounds(user_id, game_id, major_round, minor_round, action, points, hand_id)
	VALUES (4, 1, 4, 0, 3, 1300, NULL);
