<?php
//Enum for game length in rounds
class GameLength {
	const TONPUUSEN = 4;
	const HANCHAN = 8;
	const XIAPUUSEN = 12;
	const IICHAN = 16;
}

//Enum for the conditions under which a renchan takes place
class RenchanType {
	const NASHI = 0;	//Renchan never occurs
	const RYUUKYOKU = 1;	//Renchan occurs at ryuukyoku+
	const TENPAI = 2;	//Renchan occurs at dealer tenpai+
	const AGARI = 3;	//Renchan occurs at dealer win only
}

//Model class for a ruleset
class Ruleset {
	public $id;		//The ruleset's ID
	public $name;		//Name of the ruleset
	public $owner_id;	//ID of the user who created the ruleset (0 = predefined)

	//List of rules
	public $num_players, $num_rounds, $start_score, $target_score;
	public $uma_1, $uma_2, $uma_3, $uma_4;
	public $renchan, $multi_ron, $enchousen, $agariyame;
	public $akadora, $atozuke, $kuikae, $kuitan;
	public $ryanhan, $kazoe_ym, $multi_ym, $tobi;
	public $kandora, $minkan_dora, $wareme, $kiriage, $closed_ck;
	public $kyuushuu, $suufon, $suucharii, $suukaikan, $sanrenhou;
	public $dsg_pao, $dss_pao, $skt_pao, $rinshan_pao;
	public $renhou, $nagashi, $open_riichi, $paarenchan, $daisharin;
	public $sanjun, $yonjun, $sanrenkou, $suurenkou;
	public $puuta_13, $puuta_14, $tanki_dy, $junsei_dy;
	public $sanjuumen_dy, $daisuushi_dy, $daichisei;

	function __construct($id, $name, $owner) {
		$this->id = $id;
		$this->name = $name;
		$this->owner_id = $owner;

		//Default values
		$this->num_players = 	4;
		$this->num_rounds = 	GameLength::HANCHAN;
		$this->start_score = 	25000;
		$this->target_score = 	30000;
		$this->uma_1 = 		20;
		$this->uma_2 = 		10;
		$this->uma_3 = 		-10;
		$this->uma_4 = 		20;
		$this->renchan = 	RenchanType::TENPAI;
		$this->multi_ron = 	false;
		$this->enchousen = 	true;
		$this->agariyame = 	true;
		$this->akadora = 	true;
		$this->atozuke = 	true;
		$this->kuikae = 	false;
		$this->kuitan = 	true;
		$this->ryanhan = 	false;
		$this->kazoe_ym = 	true;
		$this->multi_ym = 	true;
		$this->tobi = 		true;
		$this->kandora = 	true;
		$this->minkan_dora = 	false;
		$this->wareme = 	false;
		$this->kiriage = 	true;
		$this->closed_ck = 	true;
		$this->kyuushuu = 	true;
		$this->suufon = 	true;
		$this->suucharii = 	true;
		$this->suukaikan = 	true;
		$this->sanrenhou = 	true;
		$this->dsg_pao = 	true;
		$this->dss_pao = 	true;
		$this->skt_pao = 	true;
		$this->rinshan_pao = 	true;
		$this->renhou = 	5;
		$this->nagashi = 	true;
		$this->open_riichi = 	false;
		$this->paarenchan = 	false;
		$this->daisharin = 	false;
		$this->sanjun = 	false;
		$this->yonjun = 	false;
		$this->sanrenkou = 	false;
		$this->suurenkou = 	false;
		$this->puuta_13 = 	false;
		$this->puuta_14 = 	false;
		$this->tanki_dy = 	true;
		$this->junsei_dy = 	true;
		$this->sanjuumen_dy = 	true;
		$this->daisuushi_dy = 	true;
		$this->daichisei = 	false;
	}
}
?>
