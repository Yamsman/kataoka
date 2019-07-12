USE kataoka;

-- User data
INSERT INTO users(name, email, pw) VALUES ('Choukai', 'choukai@gmail.com', 'foo');
INSERT INTO users(name, email, pw) VALUES ('Kongou', 'kongou@gmail.com', 'bar');
INSERT INTO users(name, email, pw) VALUES ('Mutsuki', 'mutsuki@gmail.com', 'baz');
INSERT INTO users(name, email, pw) VALUES ('Hibiki', 'hibiki@gmail.com', 'foobar');

-- Ruleset data
INSERT INTO rulesets(name, owner_id,
	num_players, num_rounds, start_score, target_score, 
	uma_1, uma_2, uma_3, uma_4, 
	renchan, multi_ron, enchousen, agariyame, 
	akadora, atozuke, kuikae, kuitan, 
	ryanhan, kazoe_ym, multi_ym, tobi, 
	kandora, minkan_dora, wareme, kiriage, closed_ck, 
	kyuushuu, suufon, suucharii, suukaikan, sanrenhou, 
	dsg_pao, dss_pao, skt_pao, rinshan_pao, 
	renhou, nagashi, open_riichi, paarenchan, 
	daisharin, sanjun, yonjun, sanrenkou, suurenkou, 
	puuta_13, puuta_14, tanki_dy, junsei_dy, 
	sanjuumen_dy, daisuushi_dy, daichisei
) VALUES ('Test Ruleset', 2,
	4, 8, 25000, 30000,
	20, 10, -10, -20,
	2, false, true, true,
	true, true, false, true,
	false, true, true, true,
	true, false, false, true, true,
	true, true, true, true, false,
	true, true, true, true,
	5, true, true, false,
	true, false, false, false, false,
	false, false, true, true,
	true, true, true
);

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
