<?php
require_once 'model/ruleset.php';
require_once 'interface/rsetdao_if.php';

class RulesetDAO implements RulesetDAOInterface {
	//Inserts a new ruleset into the database
	//The ruleset object's ID will be updated with the generated ID
	//Returns false if the query fails
	public static function create($conn, Ruleset &$rset) {
		//Prepare the query
		$query = $conn->prepare(
			"INSERT INTO rulesets(name, owner_id,
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
			) VALUES (?, ?,
				?, ?, ?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?, ?, ?,
				?, ?
			);"
		);

		//Bind the values and execute the query
		$query->bind_param("siiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii",
			$rset->name, $rset->owner_id,
			$rset->num_players, $rset->num_rounds, $rset->start_score, $rset->target_score,
			$rset->uma_1, $rset->uma_2, $rset->uma_3, $rset->uma_4,
			$rset->renchan, $rset->multi_ron, $rset->enchousen, $rset->agariyame, 
			$rset->akadora, $rset->atozuke, $rset->kuikae, $rset->kuitan,
			$rset->ryanhan, $rset->kazoe_ym, $rset->multi_ym, $rset->tobi,
			$rset->kandora, $rset->minkan_dora, $rset->wareme, $rset->kiriage,
			$rset->closed_ck, $rset->kyuushuu, $rset->suufon, $rset->suucharii,
			$rset->suukaikan, $rset->sanrenhou, $rset->dsg_pao, $rset->dss_pao,
			$rset->skt_pao, $rset->rinshan_pao, $rset->renhou, $rset->nagashi,
			$rset->open_riichi, $rset->paarenchan, $rset->daisharin, $rset->sanjun,
			$rset->yonjun, $rset->sanrenkou, $rset->suurenkou, $rset->puuta_13,
			$rset->puuta_14, $rset->tanki_dy, $rset->junsei_dy, $rset->sanjuumen_dy,
			$rset->daisuushi_dy, $rset->daichisei
		);
		$res = $query->execute();
		if ($res == false) return false;
		$rset->id = $conn->insert_id;
		return true;
	}

	//Updates a ruleset in the database
	//Once created, only a ruleset's name can be modified in order to protect
	//the integrity of game records that depend on rules remaining constant
	public static function update($conn, Ruleset $rset) {
		$query = $conn->prepare('UPDATE rulesets SET name = ? WHERE id = ?;');
		$query->bind_param("si", $rset->name, $rset->id);
		return $query->execute();
	}

	//Retrieves a ruleset from the database by ID
	public static function get($conn, $id) {
		$query = $conn->prepare('SELECT * FROM rulesets WHERE id = ?;');
		$query->bind_param("i", $id);
		if ($query->execute() == false) return null;

		//Create the object from the retrieved data
		$res = $query->get_result();
		$row = $res->fetch_assoc();
		$rset = new Ruleset($row['id'], $row['name'], $row['owner_id']);
		$rset->num_players = 	$row['num_players'];
		$rset->num_rounds = 	$row['num_rounds'];
		$rset->start_score = 	$row['start_score'];
		$rset->target_score = 	$row['target_score'];
		$rset->uma_1 = 		$row['uma_1'];
		$rset->uma_2 = 		$row['uma_2'];
		$rset->uma_3 = 		$row['uma_3'];
		$rset->uma_4 = 		$row['uma_4'];
		$rset->renchan = 	$row['renchan'];
		$rset->multi_ron = 	$row['multi_ron'];
		$rset->enchousen = 	$row['enchousen'];
		$rset->agariyame = 	$row['agariyame'];
		$rset->akadora = 	$row['akadora'];
		$rset->atozuke = 	$row['atozuke'];
		$rset->kuikae = 	$row['kuikae'];
		$rset->kuitan = 	$row['kuitan'];
		$rset->ryanhan = 	$row['ryanhan'];
		$rset->kazoe_ym = 	$row['kazoe_ym'];
		$rset->multi_ym = 	$row['multi_ym'];
		$rset->tobi = 		$row['tobi'];
		$rset->kandora = 	$row['kandora'];
		$rset->minkan_dora = 	$row['minkan_dora'];
		$rset->wareme = 	$row['wareme'];
		$rset->kiriage = 	$row['kiriage'];
		$rset->closed_ck = 	$row['closed_ck'];
		$rset->kyuushuu = 	$row['kyuushuu'];
		$rset->suufon = 	$row['suufon'];
		$rset->suucharii = 	$row['suucharii'];
		$rset->suukaikan = 	$row['suukaikan'];
		$rset->sanrenhou = 	$row['sanrenhou'];
		$rset->dsg_pao = 	$row['dsg_pao'];
		$rset->dss_pao = 	$row['dss_pao'];
		$rset->skt_pao = 	$row['skt_pao'];
		$rset->rinshan_pao = 	$row['rinshan_pao'];
		$rset->renhou = 	$row['renhou'];
		$rset->nagashi = 	$row['nagashi'];
		$rset->open_riichi = 	$row['open_riichi'];
		$rset->paarenchan = 	$row['paarenchan'];
		$rset->daisharin = 	$row['daisharin'];
		$rset->sanjun = 	$row['sanjun'];
		$rset->yonjun = 	$row['yonjun'];
		$rset->sanrenkou = 	$row['sanrenkou'];
		$rset->suurenkou = 	$row['suurenkou'];
		$rset->puuta_13 = 	$row['puuta_13'];
		$rset->puuta_14 = 	$row['puuta_14'];
		$rset->tanki_dy = 	$row['tanki_dy'];
		$rset->junsei_dy = 	$row['junsei_dy'];
		$rset->sanjuumen_dy = 	$row['sanjuumen_dy'];
		$rset->daisuushi_dy = 	$row['daisuushi_dy'];
		$rset->daichisei = 	$row['daichisei'];
		return $rset;
	}

	//Deletes a ruleset from the database
	//This should only be used for removing transient rulesets in the event
	//that their associated game record is deleted
	public static function delete($conn, Ruleset $rset) {
		$query = $conn->prepare('DELETE FROM rulesets WHERE id = ?;');
		$query->bind_param("i", $rset->id);
		return $query->execute();
	}
}
?>
