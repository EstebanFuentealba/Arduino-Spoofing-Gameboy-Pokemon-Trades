typedef enum {
	NOT_CONNECTED,
	CONNECTED,
	TRADE_CENTRE,
	COLOSSEUM
} connection_state_t;

typedef enum {
	INIT,
	READY_TO_GO,
	SEEN_FIRST_WAIT,
	SENDING_RANDOM_DATA,
	WAITING_TO_SEND_DATA,
	START_SENDING_DATA,
	SENDING_DATA,
	DATA_SENT
} trade_centre_state_t;

typedef unsigned char byte;

#define PKMN_BLANK						0x00

#define ITEM_1_HIGHLIGHTED				0xD0
#define ITEM_2_HIGHLIGHTED				0xD1
#define ITEM_3_HIGHLIGHTED				0xD2
#define ITEM_1_SELECTED					0xD4
#define ITEM_2_SELECTED					0xD5
#define ITEM_3_SELECTED					0xD6

#define PKMN_MASTER						0x01
#define PKMN_SLAVE						0x02
#define PKMN_CONNECTED					0x60
#define PKMN_WAIT						0x7F

#define PKMN_ACTION						0x60

#define PKMN_TRADE_CENTRE				ITEM_1_SELECTED
#define PKMN_COLOSSEUM					ITEM_2_SELECTED
#define PKMN_BREAK_LINK					ITEM_3_SELECTED

#define TRADE_CENTRE_WAIT				0xFD

