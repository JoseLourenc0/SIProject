#include "HTTPClient.h"
#include "WiFi.h"
#include "DHT.h"

#define DHTPIN 4
#define DHTTYPE DHT22

#define sensorUmidade 2

DHT dht(DHTPIN, DHTTYPE);

const char* ssid="Cavalo de Troia";
const char* password="91011355";

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid,password);
  Serial.print("Connecting...");
  while(WiFi.status()!=WL_CONNECTED){
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConnected!");
  dht.begin();//DHT
}
bool getStatus(){
    HTTPClient http;
    http.begin("http://192.168.0.16/icproject/status.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    int codigo_resposta=http.POST("senha=paodequeijo");
    bool ESPstatus=false;
    if(codigo_resposta>0){
      Serial.println("CÓDIGO HTTP "+String(codigo_resposta));
        if(codigo_resposta==200){
          String corpo_resposta=http.getString();
          if(corpo_resposta=="1"){ESPstatus=true;}
          if(corpo_resposta=="0"){ESPstatus=false;}
        }
    }else{
      Serial.print("Error sending POST, error id: ");
      Serial.println(codigo_resposta);
      ESPstatus=false;
    }
    http.end();
  return ESPstatus;
}
//DHT
float getUmidade(){
  float h = dht.readHumidity();
  if(h==0 || h=='0'){
    getUmidade();
  }
  return h;
}
float getTemperatura(){
  float t = dht.readTemperature();
  if(t==0 || t=='0'){
    getTemperatura();
  }
  return t;
}
//DHT
//Sensor umidade solo
float getUmidadeSolo(){
  float umidadeSolo=map(analogRead(sensorUmidade),4096,0,0,100);
  return umidadeSolo;
}
//Sensor umidade solo
void InsereDados(String leitura){
  HTTPClient http;
  String dados="texto="+leitura+"&dhtemperature="+getTemperatura()+"&dhumidity="+getUmidade()+"&shumidity="+getUmidadeSolo();
  http.begin("http://192.168.0.16/icproject/teste.php");
  http.addHeader("Content-Type","application/x-www-form-urlencoded");
  int codigo_resposta=http.POST(dados);
  if(codigo_resposta>0){
    Serial.print("Servidor respondeu: "+codigo_resposta);
  }
  http.end();
}

float timeinMin(float t){
  return t*60000;
}

float getInterval(){
    HTTPClient http;
    http.begin("http://192.168.0.16/icproject/time.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    int codigo_resposta=http.POST("senha=paodequeijo");
    float ESPtime=0.08;
    if(codigo_resposta>0){
        if(codigo_resposta==200){
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
      Serial.println("Data loggin enabled");
      InsereDados("Some Information");
    }else{
      Serial.println("Data logging disabled");
    }
    delay(timeinMin(getInterval()));
  }else{
    Serial.println("Erro na conexão WIFI");
    delay(timeinMin(0.25));
  }
  Serial.println("==========================");

}
