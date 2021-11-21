/* WiFi Module Code - Provider
 * Version 1.0
 * Can send kw to databse
 * Can receive message from GSM
 */

//----------- Libraries -----------
#include <EEPROM.h>
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
//---------------------------------

//----------- Global -----------
// Server
ESP8266WebServer server(80);
IPAddress apIP(192, 168, 1, 111);  // Defining a static IP address: local & gateway
const char *soft_ap_ssid = "SCEEMS_Provider";
const char *soft_ap_password = "sceemsp11";
// Client
WiFiClient client;
const int httpPort = 8080;
const char *ssid;
String sSSID = "";
const char *password;
String sPassword = "";
const char *host;
String sHost = "";
String clientURL = "";
String clientPOST = "";
String clientResponse = "";
const int requestTimeDelay = 5 * 1000;
// Client or Server Mode
String mode = "";
// EEPROM
char stringEEPROM[50];
byte lengthEEPROM;
// SERIAL COMMS
const byte numChars = 128;
char receivedChars[numChars];
String receivedMsg = "";
boolean newData = false;
//------------------------------

//----------- Functions -----------
// EEPROM - Check WiFi Config
boolean checkWiFiConfigSet() {
  byte value = EEPROM.read(0);
  if (value) {
    return true;
  }
  else {
    return false;
  }
}
//------------------------------
// EERPOM - Read Byte
byte readByte(int address) {
  byte value = -1;
  value = EEPROM.read(address);
  return value;
}
//------------------------------
// EERPOM - Read String
void readString(byte address, byte buff) {
  for(byte i = 0; i <= buff; i++) {
    stringEEPROM[i] = (char)EEPROM.read(i + address);
  }
  lengthEEPROM = buff;
}
//------------------------------
// EERPOM - Save Byte
void saveByte(int address, byte value) {
  EEPROM.write(address, value);
  EEPROM.commit();
}
//------------------------------
// EERPOM - Save String
void saveString(int address, const char* value) {
  for (byte i = 0; i <= strlen(value); i++) {
    EEPROM.write(i + address, (uint8_t)value[i]);
    EEPROM.commit();
  }
}
//------------------------------
// Client - Mode
void clientMode() {
  Serial.println();
  Serial.println("----------------------------");  
  byte x = -2;
  
  x = readByte(1);
  readString(4,x);
  for(byte i = 0; i <= lengthEEPROM; i++) {
    sSSID += stringEEPROM[i];
  }
  ssid = sSSID.c_str();
  Serial.print("SSID: ");
  Serial.println(ssid);
  
  x = readByte(2);
  readString(54,x);
  for(byte i = 0; i <= lengthEEPROM; i++) {
    sPassword += stringEEPROM[i];
  }
  password = sPassword.c_str();
  Serial.print("Password: ");
  Serial.println(password);
  
  x = readByte(3);
  readString(104,x);
  for(byte i = 0; i <= lengthEEPROM; i++) {
    sHost += stringEEPROM[i];
  }
  host = sHost.c_str();
  Serial.print("Host: ");
  Serial.println(host);
  Serial.println("----------------------------");
  Serial.println("CLIENT MODE: Active");
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  mode = "client";
}
//------------------------------
// Client - Check WiFi
boolean checkWiFiConnection() {
  boolean status = false;
  unsigned long timeout = millis();
  while (WiFi.status() != WL_CONNECTED) {
    if (millis() - timeout > 5000) {
      status = false;
      Serial.println();
      Serial.print("Status: SSID is not set / WiFi is turned off - ");
      Serial.println(WiFi.status());
      return status;
    }
    delay(500);
    Serial.print(".");
  }
  status = true;
  return status;
}
//------------------------------
// Server - Handle Root
void handleRoot() {
  char* alertMsg = "";
  boolean resetReady = false;
  if (server.arg("ssid") != "" && server.arg("password") != "" && server.arg("ip1") != "" && server.arg("ip2") != "" && server.arg("ip3") != "" && server.arg("ip4") != "") {
    char ssid[50];
    char password[50];
    char ip[50];
    server.arg("ssid").toCharArray(ssid,50);
    server.arg("password").toCharArray(password,50);
    String ipAdd = server.arg("ip1") + "." + server.arg("ip2") + "." + server.arg("ip3") + "." + server.arg("ip4");
    ipAdd.toCharArray(ip,50);
    
    strcpy(alertMsg, "<script>alert('Successfully changed SSID, Password and IP!');</script>");
    
    Serial.print("ssid:");
    Serial.println(ssid);
    Serial.print("password:");
    Serial.println(password);
    Serial.print("ip:");
    Serial.println(ip);
    
    saveByte(0, 10); // SSID Status if saved
    saveByte(1, strlen(ssid)); // Length of SSID
    saveByte(2, strlen(password)); // Length of Password
    saveByte(3, strlen(ip)); // Length of ip
    saveString(4, ssid); // SSID
    saveString(54, password); // Password
    saveString(104, ip); // IP
    resetReady = true;
  }

  char html[1000];
  // Build an HTML page to display on the web-server root address
  snprintf ( html, 1000,

  "<html>\
    <head>\
      <title>SCEEMS WiFi Configuration</title>\
      <style>\
        body { background-color: #cccccc; font-family: Arial, Helvetica, Sans-Serif; font-size: 1.5em; Color: #000000; }\
        h1 { Color: #AA0000; }\
        #save_btn { height: 36px; width: 60px }\
        .input { width: 480px; height: 36px }\
        .ip { width: 100px; height: 36px }\
      </style>\%s\
    </head>\
    <body align=\"center\">\
      <h1>SCEEMS Wi-Fi Configuration</h1>\
      <form method=\"get\" action=\"\">\
      <p>SSID:<pre><input  class=\"input\" type=\"text\" name=\"ssid\" required autofocus></pre></p>\
      <p>Password:<pre><input  class=\"input\" type=\"password\" name=\"password\" required></pre></p>\
      <p>IP:<pre><input  class=\"ip\" type=\"number\" name=\"ip1\" required>.<input  class=\"ip\" type=\"number\" name=\"ip2\" required>.<input  class=\"ip\" type=\"number\" name=\"ip3\" required>.<input  class=\"ip\" type=\"number\" name=\"ip4\" required></pre></p>\
      <p><input id=\"save_btn\" type=\"submit\" value=\"Save\"></p>\
      </form>\
    </body>\
  </html>",

   alertMsg
 );
  server.send ( 200, "text/html", html );
  if(resetReady) {
    ESP.reset();
  }
}
//------------------------------
// Server - Page not found
void handleNotFound() {
  String message = "File Not Found\n\n";
  message += "URI: ";
  message += server.uri();
  message += "\nMethod: ";
  message += ( server.method() == HTTP_GET ) ? "GET" : "POST";
  message += "\nArguments: ";
  message += server.args();
  message += "\n";

  for ( uint8_t i = 0; i < server.args(); i++ ) {
    message += " " + server.argName ( i ) + ": " + server.arg ( i ) + "\n";
  }

  server.send ( 404, "text/plain", message );
}
//------------------------------
// Server - Mode
void serverMode() {
  Serial.println();
  Serial.println("----------------------------");
  Serial.println("SERVER MODE SETUP");
  Serial.println("Configuring access point...");

  //set-up the custom IP address
  WiFi.mode(WIFI_AP_STA);
  WiFi.softAPConfig(apIP, apIP, IPAddress(255, 255, 255, 0));   // subnet FF FF FF 00

  /* You can remove the password parameter if you want the AP to be open. */
  WiFi.softAP(soft_ap_ssid, soft_ap_password);

  IPAddress myIP = WiFi.softAPIP();
  Serial.print("AP IP address: ");
  Serial.println(myIP);

  server.on ( "/", handleRoot );
  server.onNotFound ( handleNotFound );

  server.begin();
  Serial.println("----------------------------");
  Serial.println("SERVER MODE: Active");
  saveByte(0,0);
  mode = "server";
}
//------------------------------
// Client - Request to server
String requestToServer(String url, String postData) {
  client.print(String("POST ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n" +
               "Content-Type: application/x-www-form-urlencoded\r\n" +
               "Content-Length: " +
               postData.length() + "\r\n\r\n" +
               postData + "\r\n");
  Serial.println(postData);

  // Wait for server response
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      return "error";
    }
  }

  String line = "";
  // Read all the lines of the reply from server and print them to Serial
  while(client.available()){
    line = client.readStringUntil('\r');
  }
  return line;
}
//------------------------------
// Serial - Comms
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
    Serial.println(receivedMsg);
  }
}

// Setup
void setup() {
  Serial.begin(115200);
  EEPROM.begin(512);
  if (checkWiFiConfigSet()) {
    clientMode();
  }
  else {
    serverMode();
  }
}
//------------------------------

// Loop
void loop() {
  if (mode == "server") {
    server.handleClient();
  }
  else if(mode == "client") {
    recvWithStartEndMarkers();
    showNewData();
    String kw ="", id = "", type= "";
    if(receivedMsg.substring(0,2) == "KW") {
      kw = receivedMsg.substring(3,11);
      id = receivedMsg.substring(15, 22);
      type = receivedMsg.substring(26,27);
      receivedMsg = "";
    }
      
    boolean WiFiConnected = checkWiFiConnection();
    // Retry 5 connect before going to Server Mode
    static int wiFiTimeout = 0;
    if(!WiFiConnected && wiFiTimeout < 5) {
      wiFiTimeout++;
      return;
    }
    if(wiFiTimeout == 5) {
      serverMode();
    }
    
    if(kw != "") {
      // Client - Request 2 (Insert Data)
      // Establishing Connection
      Serial.print  ("Establishing connection to ");
      Serial.println(host);
      // Use WiFiClient class to create TCP connections
      if (!client.connect(host, httpPort)) {
        Serial.println("----------------------------");
        Serial.println("Failed: TCP Connection");
        return;
      } 
      // We now create a URI for the request
      clientURL = "/SCEEMS/api/set_present_kilowatts.php";
      clientPOST = "account_id="+id+"&status=Active&account_type_id="+type+"&kilowatts="+kw;
      // This will send the request to the server
      clientResponse = requestToServer(clientURL, clientPOST);
      Serial.print(clientResponse);
      Serial.println();
      Serial.println("Connection Closed");
      client.stop();
      Serial.println("----------------------------");
    }
  }
}
