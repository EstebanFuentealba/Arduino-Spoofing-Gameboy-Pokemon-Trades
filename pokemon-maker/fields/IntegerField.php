<?PHP

class IntegerField implements PokemonDataField {
	private $value;
	private $bytes;
	public function __construct($value, $bytes){
		$max = (int) (pow(2, (8*$bytes))-1);
		if($value > $max) {
			throw new Exception("Invalid value for "+$bytes+" byte field ("+$value+")");
		}

		$this->value = $value;
		$this->bytes = $bytes;
	}
	public function getHex(){
		$lowByte = "0x" . base_convert($this->value & 0xFF, 10, 16);
		$highByte = "0x" . base_convert(($this->value >> 8) & 0xFF, 10, 16);
		$higherByte = "0x" . base_convert(($this->value >> 16) & 0xFF, 10, 16);
		
		if($this->bytes == 3) {
			return PokemonData::hex(array($higherByte, $highByte, $lowByte));
		} else if($this->bytes == 2) {
			return PokemonData::hex(array($highByte, $lowByte));
		} else {
			return PokemonData::hex(array($lowByte));
		}
	}
	public function getName(){
		return (string)$this->_value;
	}
	public function getValue() {
		return $this->_value;
	}
}