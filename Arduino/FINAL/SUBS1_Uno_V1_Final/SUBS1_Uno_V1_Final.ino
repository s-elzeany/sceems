#include <SIM900D.h>
#include <SoftwareSerial.h>

#define S_D 0

// PIN NAMES
SoftwareSerial softSerial(10,11);
SIM900D gsm(softSerial);
const int ldrPin = A0;
const int relayPin = 8;
//

String providerNum = "+639053475610";
String kwText = "";
double kwContent = 0.000000;
boolean backupMode = false;
unsigned long textTimer = 0;

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
  }
}

void turnRelay(int status) {
  digitalWrite(relayPin, status);
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
  Serial.begin(115200);
  Serial.println("GSM");
  Serial.print("\r\nInitializing GSM..."); 
  setupGSM(); 
  pinMode(ldrPin, INPUT);
  pinMode(relayPin, OUTPUT);
  pinMode(13, OUTPUT);
  turnRelay(1);
}

void loop() {
  static int ldrState = LOW;
  static int oldVal = LOW;
  
  int ldrVal = analogRead(ldrPin);
  static unsigned long updateTime = millis();
  if(millis() - updateTime > 50) {
    updateTime = millis();
    if(ldrVal > 100) {
      ldrState = HIGH;
    }
    else {
      ldrState = LOW;
    }
    
    if(ldrState == HIGH && oldVal == HIGH) {
      ldrState = HIGH;
    }
    else if(ldrState == HIGH && oldVal == LOW) {
      ldrState = HIGH;
      Serial.print("*METER:");
      Serial.print(ldrState);
      Serial.println('#');
      kwContent += 0.000625;
    }
    else if(ldrState == LOW && oldVal == HIGH) {
      ldrState = LOW;
      Serial.print("* #");
    }
    else {
      ldrState = LOW;
    }
    
    oldVal = ldrState;
  }
  
  recvWithStartEndMarkers();
  showNewData();
  if (receivedMsg.substring(0, 5) == "POWER") {
    if(receivedMsg.substring(6) == "OFF") {
      turnRelay(0);
      digitalWrite(13, LOW);
    }   
    else if(receivedMsg.substring(6) == "ON") {
      turnRelay(1);
      digitalWrite(13, HIGH);
    }
    receivedMsg ="";
  }

  if(receivedMsg.indexOf("NUMBER") > -1) {
    String number = "", number2 = "", text = "";
    number = receivedMsg.substring(7,20);
    number2 = receivedMsg.substring(29,42);
    text = receivedMsg.substring(48);
    setupGSM();
    delay(100);
    Serial.print("Sending an SMS to notify owner...");  //Send an SMS
    if(gsm.sendSms(text,number)==SUCCESS) {
      Serial.println("done1.");
    } else {
      Serial.println("failed.");    
    }
    Serial.print("Sending an SMS to notify owner...");  //Send an SMS
    if(gsm.sendSms(text,number2)==SUCCESS) {
      Serial.println("done2.");
    } else {
      Serial.println("failed.");    
    }
    
    Serial.println(number);
    Serial.println(number2);
    Serial.println(text);
    receivedMsg ="";
  }

  if(receivedMsg.indexOf("MODE") > -1) {
    String mode = receivedMsg.substring(5);
    if(mode == "backup") {
      backupMode = true;
    }
    else if(mode == "normal") {
      backupMode = false;
    }
    receivedMsg ="";
  }

  if(backupMode == true) {
    if(millis() - textTimer > 10000) {
      textTimer = millis();
      kwText = "KW:" + String(kwContent,6) + ";ID:1920384;TP:1";
      if(kwContent != 0.000000) {
        setupGSM();
        delay(100);
        Serial.print("Sending text to provider...");  //Send an SMS
        if(gsm.sendSms(kwText,providerNum)==SUCCESS) {
          Serial.println("done.");
        } else {
          Serial.println("failed.");    
        }
      }
      kwContent = 0.000000;
      
      Serial.println("Displaying info:");
      Serial.println(providerNum);
      Serial.println(kwText);
    }
  }
}
