<?PHP


class StatusAilment implements PokemonDataField {

	static $None = null;
	static $Asleep = null;
	static $Poisoned = null;
	static $Burned = null;
	static $Frozen = null;
	static $Paralyzed = null;

	private $hexCode;
	private $name;

	public static $map;

	public function __construct($hexCode, $name) {
		$this->hexCode = $hexCode;
		$this->name = $name;
	}
	public static function init () {
		self::$None  	= new StatusAilment("0x00", "None");
		self::$Asleep  	= new StatusAilment("0x04", "Asleep");
		self::$Poisoned = new StatusAilment("0x08", "Poisoned");
		self::$Burned  	= new StatusAilment("0x10", "Burned");
		self::$Frozen  	= new StatusAilment("0x20", "Frozen");
		self::$Paralyzed  	= new StatusAilment("0x40", "Paralyzed");

		self::$map = array (
            "None" => self::$None,
            "Asleep"	=> self::$Asleep,
            "Poisoned" => self::$Poisoned,
			"Burned" => self::$Burned,
			"Frozen" => self::$Frozen,
			"Paralyzed" => self::$Paralyzed
        );
	}
	public static function get($element) {
        if($element == null)
            return null;
        return self::$map[$element];
    }


    public function getHex(){
    	return PokemonData::hex($this->hexCode);
    }

    public function getName(){
    	return $this->name;
    }
}
StatusAilment::init();