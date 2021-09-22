#include "HTTPClient.h"
#include "WiFi.h"
#include "DHT.h"

#define DHTPIN 4
#define DHTTYPE DHT22 //if your DHT sensor is DHT 11 USE DHTTYPE DHT11

#define humiditySensor 2

DHT dht(DHTPIN, DHTTYPE);

const char* ssid=""; //SSID of your WiFi
const char* password=""; //Password of your WiFi
const String urlPage=""; //Here you use or your remote webserver url or the ip of your machine where is turned localhost (it's your ipv4 address, something like: '192.168.0.33'). If you're gonna use localhost insert '/SIProject' after your IPV4 address

void setup() {
  Serial.begin(115200); //Default ESP32 frequency
  WiFi.begin(ssid,password); //Tries to connect to your WiFi with credentials ssid and password setted up 
  Serial.print("Connecting...");
  while(WiFi.status()!=WL_CONNECTED){
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConnected!");
  dht.begin();
}
bool getStatus(){
    HTTPClient http; //http object
    http.begin("http://"+urlPage+"/scripts/php/status.php");//Sets the page to access, as we're checking status defined by user, in this case we want to know if status = 1 or = 0
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    int response=http.POST("pin=brah");//use the correct pin, status.php is gonna get by POST method (check if it matches with what you're sending)
    bool ESPstatus=false;
    if(response>0){
      Serial.println("HTTP CODE: "+String(response));
        if(response==200){
          String echoStatus=http.getString();
          Serial.print("STATUS: ");
          Serial.println(echoStatus);
          if(echoStatus=="1"){ESPstatus=true;}
          if(echoStatus=="0"){ESPstatus=false;}
        }
    }else{
      Serial.print("Error sending POST, error id: ");
      Serial.println(response);
    }
    http.end();
  return ESPstatus;
}
//DHT
float getHumidity(){
  float h = dht.readHumidity();
  if(h==0 || h=='0'){
    getHumidity(); //prevent to send ghost data
  }
  return h;
}
float getTemperature(){
  float t = dht.readTemperature();
  if(t==0 || t=='0'){
    getTemperature();
  }
  return t;
}
//DHT
//Soil Moisture Sensor
float getSoilMoisture(){
  float sm=map(analogRead(humiditySensor),4096,0,0,100);
  return sm;
}
//Soil Moisture Sensor
void insertData(String l){
  HTTPClient http;
  String d="text="+l+"&dhtemperature="+getTemperature()+"&dhumidity="+getHumidity()+"&shumidity="+getSoilMoisture();
  http.begin("http://"+urlPage+"/scripts/php/insertdata.php");
  http.addHeader("Content-Type","application/x-www-form-urlencoded");
  int response=http.POST(d);
  if(response>0){
    Serial.println("HTTP CODE: "+String(response));
  }
  http.end();
}

float timeinMin(float t){
  return t*60000;
}

float getInterval(){
    HTTPClient http;
    http.begin("http://"+urlPage+"/scripts/php/time.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    int response=http.POST("pin=brah");
    float ESPtime=1;//Interval setted to 1 min in case it fails to request interval by user
    if(response>0){
        if(response==200){
          String TimeFromUser=http.getString();
          int t = TimeFromUser.toInt();
          if(t>=0){
            ESPtime=t;
          }
        }
    }
    http.end();
    Serial.print("Recording ESP32 Interval: ");
    Serial.println(ESPtime);
    return ESPtime;
}

void loop() {
  if(WiFi.status()==WL_CONNECTED){
    if(getStatus()==true){
      Serial.println("Data logging enabled");
      insertData("Some Information");
    }else{
      Serial.println("Data logging disabled");
    }
    delay(timeinMin(getInterval()));
  }else{
    Serial.println("WIFI Connection ERROR");
    delay(timeinMin(0.25));
  }
  Serial.println("==========================");

}
