// Esteban Fuentealba
// 2014/05/12

// Link Cable     Arduino      Desc
// 6              GND          GND
// 5              2            SC
// 2              3            SI
// 3              4            SO


#include "pokemon.h"
#include "pokemonspoof.h"



int volatile CLOCK_PIN = 2;
int volatile SO_PIN = 4;
int volatile SI_PIN = 3;
int volatile data = 0;
int volatile val = 0;
int ledStatus = 13;

unsigned volatile long lastReceive = 0;
volatile byte outputBuffer = 0x00;
volatile int counterRead = 0;

volatile int counter = 0;
volatile connection_state_t connection_state = NOT_CONNECTED;
volatile trade_centre_state_t trade_centre_state = INIT;



void setup() {
  pinMode(SI_PIN, INPUT);
  digitalWrite( SI_PIN, HIGH);  
  pinMode(SO_PIN, OUTPUT);
  pinMode(ledStatus, OUTPUT);
  digitalWrite(ledStatus, LOW);
  digitalWrite(SO_PIN, LOW);
  pinMode(CLOCK_PIN, INPUT);
  digitalWrite(CLOCK_PIN, HIGH);
  Serial.begin(9600);
  attachInterrupt( 0, clockInterrupt, RISING );
  
}


void clockInterrupt(void) {
  byte in;
  unsigned long t = 0;
  if(lastReceive > 0) {
    if( micros() - lastReceive > 120 ) {
      counterRead = 0;
      val = 0;
      in = 0x00;
    }
  }
  data = digitalRead(SI_PIN);
  if(data == HIGH){
    val |= ( 1 << (7-counterRead) );
    in |= ( 1 << (7-counterRead) );
  }
  if(counterRead == 7) {
    outputBuffer = handleIncomingByte((byte)val);
    val = 0;
    in = 0x00;
    counterRead = -1;
  }
  
  counterRead++;
  lastReceive = micros();
  while( ((digitalRead(CLOCK_PIN) | CLOCK_PIN) & CLOCK_PIN)  == 0);
  digitalWrite(SO_PIN, outputBuffer & 0x80 ? SO_PIN : 0);
  outputBuffer = outputBuffer << 1;
}
byte handleIncomingByte(byte in) {
	byte send = 0x00;
	switch(connection_state) {
	case NOT_CONNECTED:
		if(in == PKMN_MASTER)
			send = PKMN_SLAVE;
		else if(in == PKMN_BLANK)
			send = PKMN_BLANK;
		else if(in == PKMN_CONNECTED) {
			send = PKMN_CONNECTED;
			connection_state = CONNECTED;
                        digitalWrite(ledStatus, HIGH);
		}
		break;

	case CONNECTED:
		if(in == PKMN_CONNECTED)
			send = PKMN_CONNECTED;
		else if(in == PKMN_TRADE_CENTRE)
			connection_state = TRADE_CENTRE;
		else if(in == PKMN_COLOSSEUM)
			connection_state = COLOSSEUM;
		else if(in == PKMN_BREAK_LINK || in == PKMN_MASTER) {
			connection_state = NOT_CONNECTED;
			send = PKMN_BREAK_LINK;
                        digitalWrite(ledStatus, LOW);
		} else {
			send = in;
		}
		break;

	case TRADE_CENTRE:
		if(trade_centre_state == INIT && in == 0x00) {
			if(counter++ == 5) {
				trade_centre_state = READY_TO_GO;
			}
			send = in;
		} else if(trade_centre_state == READY_TO_GO && (in & 0xF0) == 0xF0) {
			trade_centre_state = SEEN_FIRST_WAIT;
			send = in;
		} else if(trade_centre_state == SEEN_FIRST_WAIT && (in & 0xF0) != 0xF0) {
			send = in;
			counter = 0;
			trade_centre_state = SENDING_RANDOM_DATA;
		} else if(trade_centre_state == SENDING_RANDOM_DATA && (in & 0xF0) == 0xF0) {
			if(counter++ == 5) {
				trade_centre_state = WAITING_TO_SEND_DATA;
			}
			send = in;
		} else if(trade_centre_state == WAITING_TO_SEND_DATA && (in & 0xF0) != 0xF0) {
			counter = 0;
			send = DATA_BLOCK[counter++];
			trade_centre_state = SENDING_DATA;
		} else if(trade_centre_state == SENDING_DATA) {
			send = DATA_BLOCK[counter++];
			if(counter == 415) {
				trade_centre_state = DATA_SENT;
			}
		} else {
			send = in;
		}
		break;

	case COLOSSEUM:
		send = in;
		break;

	default:
		send = in;
		break;
	}

	return send;
}

void loop() { 

 }



