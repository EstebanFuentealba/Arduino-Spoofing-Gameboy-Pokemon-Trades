<?PHP

require_once(dirname(__FILE__).'/TextConverter.php');
require_once(dirname(__FILE__).'/PokemonDataField.php');
require_once(dirname(__FILE__).'/PokemonData.php');

require_once(dirname(__FILE__).'/fields/IntegerField.php');
require_once(dirname(__FILE__).'/fields/Type.php');
require_once(dirname(__FILE__).'/fields/StatusAilment.php');
require_once(dirname(__FILE__).'/fields/Species.php');
require_once(dirname(__FILE__).'/fields/Move.php');
require_once(dirname(__FILE__).'/fields/Item.php');

require_once(dirname(__FILE__).'/Utils.php');



$trainerName = 'Enc0de!';




$pokemons = array();

$data = new PokemonData(
	Species::$Articuno, 
	300, 
	74, 
	StatusAilment::$None, 
	Type::$Fire, // THIS IS IGNORED ONCE TRADE COMMENCES
	Type::$Ghost, // THIS IS IGNORED ONCE TRADE COMMENCES
	Item::$Calcium, 
	Move::$FireBlast,
	Move::$HydroPump, 
	Move::$ThunderPunch, 
	Move::$MegaKick, 
	1234, 
	200000, 
	65535, 
	65535, 
	65535, 
	65535, 
	65535, 
	65535, 
	Utils::pp(3, 0),
	Utils::pp(3, 0), 
	Utils::pp(3, 0), 
	Utils::pp(3, 0), 
	74, 
	300, 
	150, 
	151, 
	152, 
	153,
	"",
	$trainerName
);
$pokemons[] = $data;




$blocksArray = array(
	Utils::trainerName($trainerName),
	Utils::pokemonTypeBlock($pokemons),
	$pokemons[0]->getBytes(), // pokemon1
	$pokemons[0]->getBytes(), // pokemon2
	$pokemons[0]->getBytes(), // pokemon3
	$pokemons[0]->getBytes(), // pokemon4
	$pokemons[0]->getBytes(), // pokemon5
	$pokemons[0]->getBytes(), // pokemon6
	Utils::trainerName($pokemons[0]->getOriginalTrainerName()), // trainer1
	Utils::trainerName($pokemons[0]->getOriginalTrainerName()), // trainer2
	Utils::trainerName($pokemons[0]->getOriginalTrainerName()), // trainer3
	Utils::trainerName($pokemons[0]->getOriginalTrainerName()), // trainer4
	Utils::trainerName($pokemons[0]->getOriginalTrainerName()), // trainer5
	Utils::trainerName($pokemons[0]->getOriginalTrainerName()), // trainer6
	$pokemons[0]->getTerminatedNickname(), // trainer1
	$pokemons[0]->getTerminatedNickname(), // trainer2
	$pokemons[0]->getTerminatedNickname(), // trainer3
	$pokemons[0]->getTerminatedNickname(), // trainer4
	$pokemons[0]->getTerminatedNickname(), // trainer5
	$pokemons[0]->getTerminatedNickname() // trainer6
);

$dataBlock = Utils::concatenate($blocksArray); 
file_put_contents(dirname(__FILE__).'/output.h',Utils::makeArray("DATA_BLOCK", $dataBlock));
?>