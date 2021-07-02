#include "HTTPClient.h"
#include "WiFi.h"
#include "DHT.h"

#define DHTPIN 4
#define DHTTYPE DHT22

#define sensorUmidade 2

DHT dht(DHTPIN, DHTTYPE); //objeto criado identificando o pino e o tipo de dht para a biblioteca

const char* ssid="Cavalo de Troia";
const char* password="91011355";

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid,password);
  Serial.print("Conectando...");
  while(WiFi.status()!=WL_CONNECTED){
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConcetado!");
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
      Serial.print("Erro enviando POST, codigo: ");
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

float tempoEmMinutos(float t){
  return t*60000;
}

void loop() {
  if(WiFi.status()==WL_CONNECTED){
    if(getStatus()==true){
      Serial.println("Registro de dados ligado");
      InsereDados("TextoLegal");
    }else{
      Serial.println("Registro de dados desligado");
    }
    
  }else{
    Serial.println("Erro na conexão WIFI");
  }
  delay(tempoEmMinutos(1));

}
