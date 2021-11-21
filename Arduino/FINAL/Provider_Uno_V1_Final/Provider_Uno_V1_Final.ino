#include <SIM900D.h>
#include <SoftwareSerial.h>

#define S_D 0

// PIN NAMES
SoftwareSerial softSerial(10,11);
SIM900D gsm(softSerial);
//

// SERIAL COMMS
const byte numChars = 128;
char receivedChars[numChars];
String receivedMsg = "";
boolean newData = false;
//

void recvWithStartEndMarkers() {
  static boolean recvInProgress = false;
  static byte ndx = 0;
  char startMarker = '*';
  char endMarker = '#';
  char rc;

  while (Serial.available() > 0 && newData == false) {
    rc = Serial.read();

    if (recvInProgress == true) {
      if (rc != endMarker) {
        receivedChars[ndx] = rc;
        ndx++;
        if (ndx >= numChars) {
          ndx = numChars - 1;
        }
      }
      else {
        receivedChars[ndx] = '\0'; // terminate the string
        recvInProgress = false;
        ndx = 0;
        newData = true;
      }
    }

    else if (rc == startMarker) {
      recvInProgress = true;
    }
  }
}

void showNewData() {
  if (newData == true) {
    receivedMsg = receivedChars;
    newData = false;
    //zSerial.println(receivedMsg);
  }
}

void setupGSM() {
  unsigned char result = gsm.begin(9600);     //Initialize the GSM shield
  if(result == false)
  {
    Serial.println("failed!");  
    Serial.print("Don't forget to press the POWERKEY button.");
  }
  Serial.println("done");
}

void setup() {
  pinMode(13, OUTPUT);
  digitalWrite(13, LOW);
  Serial.begin(115200);
  Serial.println("GSM");
  Serial.print("\r\nInitializing GSM...");  
  setupGSM(); 
}

void loop() {
  setupGSM();
  delay(100);
  if(gsm.smsAvailable(UNREAD)) {
    Serial.println("\r\nReading new SMS...");  

    unsigned int sim_addr = gsm.getNewSmsAddr();   // Get the SIM address of the
    SMS_RX new_sms = gsm.getSms(sim_addr);         // new SMS
    
    String sms_msg = new_sms.getMessage();         // Read the message
    String sender_num = new_sms.getSenderNumber(); // and the sender Number

    Serial.print("\r\nSimAddr: "); Serial.println(sim_addr);  //View data
    Serial.print("SenderNum: ");   Serial.println(sender_num);
    Serial.print("SMS Msg: ");     Serial.println(sms_msg);   
    
    sms_msg.trim();                          //Remove any leading/trailing white
                                             // space
    sms_msg.toUpperCase();                   // Capitalize all characters
    
    if(sms_msg.indexOf("KW") > -1 && sms_msg.indexOf("ID") > -1 && sms_msg.indexOf("TP") > -1) {
      String kw ="", id = "", type= "";
      kw = sms_msg.substring(3,11);
      id = sms_msg.substring(15, 22);
      type = sms_msg.substring(26,27);
      Serial.print("*KW:"+kw+";ID:"+id+";TP:"+type+"#");
      digitalWrite(13, HIGH);
      delay(100);
      digitalWrite(13, LOW);
      delay(100);
    }
  } 
  
}
