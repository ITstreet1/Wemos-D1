/*
 *Skeč za potrebe članka u Svetu Kompjutera 
 *Author: Petrović Dejan
 *Date: 31/12/2017
 *WemosD1, LM35
 */
#include <ESP8266WiFi.h>
// WiFi podaci za konekciju na lokalnu mrežu
const char ssid[] = "***vaš SSID*****";
const char password[] = "****vaša lozinka****";
// lokacija udaljenog servera, može biti IP adresa ili URL adresa
const char webServer[] = "***naziv ili IP servera ****";
const int httpPort = 80;
WiFiClient client;
// LM35 setup
float temp;
int tempPin = 0;
void setup() {
  Serial.begin(9600);
  // WiFi konekcija na lokalnu mrežu
  WiFi.begin(ssid,password);
  while(WiFi.status()!=WL_CONNECTED){
    delay(500);
    Serial.print(".");
    }
  Serial.println("");
  Serial.println("Povezan na lokalnu mrežu!");
}
void loop() {
  // malo matematike za dobijanje ispravne vrednosti
  temp = (3.3*analogRead(tempPin)*100.0)/1024;
  // povezujemo se na udaljeni server
  if (client.connect(webServer, httpPort) ) {
  Serial.println("Povezan na udaljeni server!");
  // šaljemo GET zahtev
  client.print("GET /index.php?lm35=");
  client.print(temp);
  //Serial.println("Ocitana vrednost je poslata na server!");
  //Serial.print("temp ");
  //Serial.println(temp);
  // po potrebi se može dodati još senzora a njihove vrednosti poslati u nizu GET zahteva
  //client.print("&drugiSenzor=");
  //client.print(vrednost);
  client.println(" HTTP/1.1");
  client.print("Host: ");
  client.println(webServer);
  client.println("Connection: close");
  Serial.println("Konekcija zatvorena");
  client.println();
  delay(600000);
  } 
}
 
