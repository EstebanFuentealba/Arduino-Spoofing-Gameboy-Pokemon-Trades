<?PHP


class PokemonData {
	public static function hex($values) {
		return $values;
	}



	private $species;
	private $currentHp;
	private $levelPc;
	private $statusAilment;
	private $type1;
	private $type2;
	private $itemHeld;
	private $move1;
	private $move2;
	private $move3;
	private $move4;
	private $originalTrainerId;
	private $exp;
	private $hpEv;
	private $attackEv;
	private $defenseEv;
	private $speedEv;
	private $specialEv;
	private $iv;
	private $move1pp;
	private $move2pp;
	private $move3pp;
	private $move4pp;
	private $level;
	private $maxHp;
	private $attack;
	private $defense;
	private $speed;
	private $special;
	
	private $nickname;
	private $originalTrainerName;

	public function __construct($species,
			$currentHp,
			$levelPc,
			$statusAilment,
			$type1,
			$type2,
			$itemHeld,
			$move1,
			$move2,
			$move3,
			$move4,
			$originalTrainerId,
			$exp,
			$hpEv,
			$attackEv,
			$defenseEv,
			$speedEv,
			$specialEv,
			$iv,
			$move1pp,
			$move2pp,
			$move3pp,
			$move4pp,
			$level,
			$maxHp,
			$attack,
			$defense,
			$speed,
			$special,
			$nickname,
			$originalTrainerName){


			$this->species = $species;
			$this->currentHp = new IntegerField($currentHp, 2);
			$this->levelPc = new IntegerField($levelPc, 1);
			$this->statusAilment = $statusAilment;
			$this->type1 = $type1;
			$this->type2 = $type2;
			$this->itemHeld = $itemHeld;
			$this->move1 = $move1;
			$this->move2 = $move2;
			$this->move3 = $move3;
			$this->move4 = $move4;
			$this->originalTrainerId = new IntegerField($originalTrainerId, 2);
			$this->exp = new IntegerField($exp, 3);
			$this->hpEv = new IntegerField($hpEv, 2);
			$this->attackEv = new IntegerField($attackEv, 2);
			$this->defenseEv = new IntegerField($defenseEv, 2);
			$this->speedEv = new IntegerField($speedEv, 2);
			$this->specialEv = new IntegerField($specialEv, 2);
			$this->iv = new IntegerField($iv, 2);
			$this->move1pp = new IntegerField($move1pp, 1);
			$this->move2pp = new IntegerField($move2pp, 1);
			$this->move3pp = new IntegerField($move3pp, 1);
			$this->move4pp = new IntegerField($move4pp, 1);
			$this->level = new IntegerField($level, 1);
			$this->maxHp = new IntegerField($maxHp, 2);
			$this->attack = new IntegerField($attack, 2);
			$this->defense = new IntegerField($defense, 2);
			$this->speed = new IntegerField($speed, 2);
			$this->special = new IntegerField($special, 2);

			$this->nickname = $nickname;
			if(strlen($nickname) > 10)
				throw new Exception("Nickname cannot be more than 10 characters long");

			$this->originalTrainerName = $originalTrainerName;
			if(strlen($originalTrainerName) > 7)
				throw new Exception("Original trainer name cannot be more than 7 characters long");
	}

	public function getTerminatedNickname() {
		return TextConverter::padTo(TextConverter::terminate(TextConverter::convert($nickname)), "0x50", 11);
	}
	
	public function getOriginalTrainerName() {
		return $this->originalTrainerName;
	}

	public function getBytes() {
		$bytes = array();
		
		$this->setBytes($bytes, $this->species->getHex());
		$this->setBytes($bytes, $this->currentHp->getHex());
		$this->setBytes($bytes, $this->levelPc->getHex());
		$this->setBytes($bytes, $this->statusAilment->getHex());
		$this->setBytes($bytes, $this->type1->getHex());
		$this->setBytes($bytes, $this->type2->getHex());
		$this->setBytes($bytes, $this->itemHeld->getHex());
		$this->setBytes($bytes, $this->move1->getHex());
		$this->setBytes($bytes, $this->move2->getHex());
		$this->setBytes($bytes, $this->move3->getHex());
		$this->setBytes($bytes, $this->move4->getHex());
		$this->setBytes($bytes, $this->originalTrainerId->getHex());
		$this->setBytes($bytes, $this->exp->getHex());
		$this->setBytes($bytes, $this->hpEv->getHex());
		$this->setBytes($bytes, $this->attackEv->getHex());
		$this->setBytes($bytes, $this->defenseEv->getHex());
		$this->setBytes($bytes, $this->speedEv->getHex());
		$this->setBytes($bytes, $this->specialEv->getHex());
		$this->setBytes($bytes, $this->iv->getHex());
		$this->setBytes($bytes, $this->move1pp->getHex());
		$this->setBytes($bytes, $this->move2pp->getHex());
		$this->setBytes($bytes, $this->move3pp->getHex());
		$this->setBytes($bytes, $this->move4pp->getHex());
		$this->setBytes($bytes, $this->level->getHex());
		$this->setBytes($bytes, $this->maxHp->getHex());
		$this->setBytes($bytes, $this->attack->getHex());
		$this->setBytes($bytes, $this->defense->getHex());
		$this->setBytes($bytes, $this->speed->getHex());
		$this->setBytes($bytes, $this->special->getHex());

		return $bytes;
	}
	public function setBytes(&$bytes, $data) {
		if(is_array($data)){
			foreach($data as $item) {
				$bytes[] = $item;
			}
		} else {
			$bytes[] = $data;
		}
		return $bytes;
	}

	public function getSpecies() {
		return $this->species;
	}
}