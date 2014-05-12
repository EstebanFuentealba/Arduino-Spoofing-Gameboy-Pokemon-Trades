<?PHP

class Type implements PokemonDataField {

	static $Normal = null;
	static $Fighting = null;
	static $Flying = null;
	static $Poison = null;
	static $Ground = null;
	static $Rock = null;
	static $Bug = null;
	static $Ghost = null;
	static $Fire = null;
	static $Water = null;
	static $Grass = null;
	static $Electric = null;
	static $Psychic = null;
	static $Ice = null;
	static $Dragon = null;

	private $hexCode;
	private $name;

	public static $map;

	public function __construct($hexCode, $name) {
		$this->hexCode = $hexCode;
		$this->name = $name;
	}
	public static function init () {
		self::$Normal  	= new Type("0x00", "Normal");
		self::$Fighting = new Type("0x01", "Fighting");
		self::$Flying  = new Type("0x02", "Flying");
		self::$Poison  = new Type("0x03", "Poison");
		self::$Ground  = new Type("0x04", "Ground");
		self::$Rock  = new Type("0x05", "Rock");
		self::$Bug  = new Type("0x07", "Bug");
		self::$Ghost  = new Type("0x08", "Ghost");
		self::$Fire  = new Type("0x14", "Fire");
		self::$Water  = new Type("0x15", "Water");
		self::$Grass  = new Type("0x16", "Grass");
		self::$Electric  = new Type("0x17", "Electric");
		self::$Psychic  = new Type("0x18", "Psychic");
		self::$Ice  = new Type("0x19", "Ice");
		self::$Dragon  = new Type("0x1A", "Dragon");

        self::$map = array (
            "Normal" => self::$Normal,
            "Fighting"	=> self::$Fighting,
            "Flying" => self::$Flying,
			"Poison" => self::$Poison,
			"Ground" => self::$Ground,
			"Rock" => self::$Rock,
			"Bug" => self::$Bug,
			"Ghost" => self::$Ghost,
			"Fire" => self::$Fire,
			"Water" => self::$Water,
			"Grass" => self::$Grass,
			"Electric" => self::$Electric,
			"Psychic" => self::$Psychic,
			"Ice" => self::$Ice,
			"Dragon" => self::$Dragon
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
Type::init();