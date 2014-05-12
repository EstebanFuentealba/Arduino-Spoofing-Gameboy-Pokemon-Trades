<?PHP

class Utils {
	
	public static function pp($ppUpUsed, $currentPp) {
		if($ppUpUsed > 3)
			throw new IllegalArgumentException("Can only use PP-Up a maximum of 3 times on any one move");
		if($currentPp >= 64)
			throw new IllegalArgumentException("No move can have greater than 63 PP");
		
		return $ppUpUsed << 6 | $currentPp;
	}
	public static function trainerName($name) {
		if(strlen($name) > 7)
			throw new Exception("Trainer name cannot be more than 7 characters long");
		return TextConverter::padTo(TextConverter::terminate(TextConverter::convert($name)), "0x00", 11);
	}
	public static function pokemonTypeBlock($pokemons) {
		
		$out = array();
		
		$out[] = "0x".base_convert(count($pokemons), 10, 16);
		for($i = 0 ; $i < 6 ; $i++) {
			if($i < count($pokemons)) {
				$out[] = $pokemons[$i]->getSpecies()->getHex();
			} else {
				$out[] = "0xFF";
			}
		}
		$out[] = "0xFF";
		
		return $out;
	}
	public static function concatenate($byteLists) {
		$concatenated = array();
		foreach($byteLists as $bytes) {
			foreach($bytes as $byte) {
				$concatenated[] = $byte; 
			}
		}
		return $concatenated;
	}

	public static function makeArray($name, $bytes) {
		return join('', array('unsigned char ', $name, '[', count($bytes), '] = {', join(', ', $bytes), "};\n"));
	}
}