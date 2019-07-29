DROP SCHEMA IF EXISTS kataoka;
CREATE SCHEMA kataoka;
USE kataoka;

/*
 * User table
 * Holds the information for user accounts.
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
 *
 * TODO: Rule variations on atamahane
 * TODO: Explicit value for oka
 * TODO: Yakitori method and value
 * TODO: Variations on akadora
 * TODO: Variations on open riichi
 * TODO: Chonbo method and value
 */
CREATE TABLE rulesets (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(64),
	owner_id INT,

	-- General
	num_players	INT NOT NULL,	-- 3 for sanma, 4 for yonma
	num_rounds	INT NOT NULL,	-- 4 for tonpuusen, 8 for hanchan, etc.
	start_score	INT NOT NULL,	-- Starting points
	target_score	INT NOT NULL,	-- Target score
	uma_1		INT NOT NULL,	-- Uma for first place
	uma_2		INT NOT NULL,	-- Uma for second place
	uma_3		INT NOT NULL,	-- Uma for third place
	uma_4		INT NOT NULL,	-- Uma for fourth place
	renchan		INT NOT NULL,	-- Renchan condition? 0/1/2/3 -> nashi/ryuukyoku/tenpai/agari
	multi_ron	BIT NOT NULL,	-- Is double/triple ron allowed? T/F
	enchousen	BIT NOT NULL,	-- Extra wind for not meeting target score? T/F
	agariyame 	BIT NOT NULL,	-- Agariyame used? T/F
	akadora 	BIT NOT NULL,	-- Red dora used? T/F
	atozuke 	BIT NOT NULL,	-- Yakuless tenpai allowed? T/F
	kuikae	 	BIT NOT NULL,	-- Swap calling allowed? T/F
	kuitan 		BIT NOT NULL,	-- Open tanyao allowed? T/F
	ryanhan 	BIT NOT NULL,	-- Two-han binding? T/F
	kazoe_ym	BIT NOT NULL,	-- Kazoe yakuman? T/F
	multi_ym	BIT NOT NULL,	-- Multiple yakuman? T/F
	tobi		BIT NOT NULL,	-- Bankruptcy? T/F
	kandora		BIT NOT NULL,	-- Calling kan adds dora indicators? T/F
	minkan_dora	BIT NOT NULL,	-- Minkan dora timing? T/F -> before/after
	wareme		BIT NOT NULL,	-- Wall breaker pays and recieves double? T/F
--	yakitori	BIT NOT NULL,	-- Penalty for never winning a hand? T/F
	kiriage		BIT NOT NULL,	-- Round 4han 30fu, etc to mangan? T/F
	closed_ck	BIT NOT NULL,	-- Chankan on closed kan for kokushi tenpai? T/F

	-- Abortive draws
	kyuushuu	BIT NOT NULL,	-- Kyuushuu kyuuhai allowed? T/F
	suufon		BIT NOT NULL,	-- Suufon renda used? T/F
	suucharii	BIT NOT NULL,	-- Suucha riichi used? T/F
	suukaikan	BIT NOT NULL,	-- Suukaikan used? T/F
	sanrenhou	BIT NOT NULL,	-- If multi-ron is allowed, does triple ron abort? T/F

	-- Sekinin barai
	dsg_pao		BIT NOT NULL,	-- Pao on Daisangen? T/F
	dss_pao		BIT NOT NULL,	-- Pao on Daisuushi? T/F
	skt_pao		BIT NOT NULL,	-- Pao on Suukantsu? T/F
	rinshan_pao	BIT NOT NULL,	-- Pao on Rinshan Kaihou? T/F

	-- Yaku
	renhou		INT NOT NULL,	-- Value of renhou? 0/1/5/13
	nagashi		BIT NOT NULL,	-- Nagashi mangan allowed? T/F
	open_riichi	BIT NOT NULL,	-- Open riichi allowed? T/F
	paarenchan	BIT NOT NULL,	-- Paarenchan used? T/F
	daisharin	BIT NOT NULL,	-- Daisharin used? T/F
	sanjun		BIT NOT NULL,	-- Iishoku Sanjun used? T/F
	yonjun		BIT NOT NULL,	-- Iishoku Yonjun used? T/F
	sanrenkou	BIT NOT NULL,	-- Sanrenkou used? T/F
	suurenkou	BIT NOT NULL,	-- Suurenkou used? T/F
	puuta_13	BIT NOT NULL,	-- Shiisanpuuta used? T/F
	puuta_14	BIT NOT NULL,	-- Shiisuupuuta used? T/F
	tanki_dy	BIT NOT NULL,	-- Suuankou Tanki as double yakuman? T/F
	junsei_dy	BIT NOT NULL,	-- Junsei Chuuren Poutou as double yakuman? T/F
	sanjuumen_dy	BIT NOT NULL,	-- Kokushi 13-sided wait as double yakuman? T/F
	daisuushi_dy	BIT NOT NULL,	-- Daisuushi as double yakuman? T/F
	daichisei	BIT NOT NULL,	-- Chiitoitsu + Tsuuiisou as double yakuman? T/F

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
 *
 * The hand's tiles are stored as a single string formatted
 * as detailed by the OpenMJ universal mahjong protocol:
 * Tile notation:
 *  - One numeric digit and one alphabetic letter represents one tile.
 *  - The alphabet is m (manzu), p (pinzu), s (souzu), z (tsuupai).
 *  - Honor tiles are in the order ton, nan, xia, pei, haku, hatsu, chun, from 1z~7z.
 *  - Uppercase alphabet are used for akadora.
 * Hand notation:
 *  - Tiles in the hand are sorted. The order is m->p->s->z, 1->9.
 *  - Self-drawn tiles are generally lined up, while open tiles are surrounded with <>. For ankan, ().
 *  - All spaces are removed.
 * https://ja.osdn.net/projects/openmj/wiki/UMP
 * As an extension, abbreviations may be used, for example 1m2m3m may be represented as 123m.
 */
CREATE TABLE hands (
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,		-- User who won the hand
	rules_id INT NOT NULL,		-- Ruleset associated with the hand
	tiles VARCHAR(48),		-- Tile composition of the hand
	open BIT NOT NULL,		-- Is the hand open? T/F
	win_type BIT NOT NULL,		-- Ron or tsumo? T/F
	han INT NOT NULL,		-- Han value; Non-kazoe yakuman are multiples of -13
	fu INT NOT NULL,		-- Fu value; Defaults to 30 if negilible
	dora INT NOT NULL,		-- Number of dora the hand has (including aka)
	riichi BIT NOT NULL,		-- Did the player call riichi? T/F
	ippatsu BIT NOT NULL,		-- Did the player win with ippatsu? T/F
	haitei BIT NOT NULL,		-- Did the player win with haitei/houtei? T/F
	rinshan BIT NOT NULL,		-- Did the player win by rinshan kaihou? T/F
	chankan BIT NOT NULL,		-- Did the player win by chankan? T/F
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
 * A set of round data is identified by a combination of the
 * game ID, major round, and minor round. Within that set, a player's
 * action during the round is identified by their ID.
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
