<?PHP

class TextConverter {
	private static $table = array(
		' ' => "0x7F",
		'A' => "0x80",
		'B' => "0x81",
		'C' => "0x82",
		'D' => "0x83",
		'E' => "0x84",
		'F' => "0x85",
		'G' => "0x86",
		'H' => "0x87",
		'I' => "0x88",
		'J' => "0x89",
		'K' => "0x8A",
		'L' => "0x8B",
		'M' => "0x8C",
		'N' => "0x8D",
		'O' => "0x8E",
		'P' => "0x8F",
		'Q' => "0x90",
		'R' => "0x91",
		'S' => "0x92",
		'T' => "0x93",
		'U' => "0x94",
		'V' => "0x95",
		'W' => "0x96",
		'X' => "0x97",
		'Y' => "0x98",
		'Z' => "0x99",
		'a' => "0xA0",
		'b' => "0xA1",
		'c' => "0xA2",
		'd' => "0xA3",
		'e' => "0xA4",
		'f' => "0xA5",
		'g' => "0xA6",
		'h' => "0xA7",
		'i' => "0xA8",
		'j' => "0xA9",
		'k' => "0xAA",
		'l' => "0xAB",
		'm' => "0xAC",
		'n' => "0xAD",
		'o' => "0xAE",
		'p' => "0xAF",
		'q' => "0xB0",
		'r' => "0xB1",
		's' => "0xB2",
		't' => "0xB3",
		'u' => "0xB4",
		'v' => "0xB5",
		'w' => "0xB6",
		'x' => "0xB7",
		'y' => "0xB8",
		'z' => "0xB9",
		'-' => "0xE3",
		'?' => "0xE6",
		'!' => "0xE7",
		'.' => "0xE8",
		',' => "0xF4",
		'0' => "0xF6",
		'1' => "0xF7",
		'2' => "0xF8",
		'3' => "0xF9",
		'4' => "0xFA",
		'5' => "0xFB",
		'6' => "0xFC",
		'7' => "0xFD",
		'8' => "0xFE",
		'9' => "0xFF"
	);

	public static function convert($text) {
		$bytes = array();
		for($i = 0 ; $i < strlen($text); $i++) {
			$c = $text{$i};
			$converted = self::$table[$c];
			$bytes[] = ($converted == '') ? '.' : $converted;
		}
		return $bytes;
	}
	public static function terminate($bytes) {
		$list = $bytes;
		$list[] = "0x50";
		return $list;
	}
	public static function padTo($bytes, $with, $lengthBytes) {
		$list = $bytes;
		while(count($list) < $lengthBytes)
			$list[] = $with;
		return $list;
	}
}