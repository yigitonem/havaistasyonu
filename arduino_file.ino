/*
  Yigit Onem havaistasyonu_v2
  www.yigitonem.com/havaistasyonu
*/

//ESP
#ifdef ESP32
  #include <WiFi.h>
  #include <HTTPClient.h>
#else
  #include <ESP8266WiFi.h>
  #include <ESP8266HTTPClient.h>
  #include <WiFiClient.h>
#endif

//LCD MODUL
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x27,16,2);

//DHT11
#include "DHT.h"
#define DHTPIN D5
#define DHTTYPE DHT11
DHT dht(DHTPIN,DHTTYPE);

//Saat bilgisi icin
#include <NTPClient.h>
#include <WiFiUdp.h>
const long utcOffsetInSeconds = 10800;
char daysOfTheWeek[7][12] = {"Paz", "Pzt", "Sal", "Crs", "Per", "Cum", "Cmt"};
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP, "pool.ntp.org", utcOffsetInSeconds);

#define uyari D6

//Hava Bilgisi icin degiskenler
float sic;
float nem;

// Ag bilgisi
const char* ssid     = "Wifi Adı";
const char* password = "Şifre";

// Sunucu dosya yolu
const char* serverName = " /*Veritabanı Kayıt İşleminin Yapıldığı PHP Dosyası */ ";

// Guvenlik amaciyla koydugumuz api key
String apiKeyValue = "API Key";

float humidityData;
float temperatureData;
int bas = 0;

void setup() {
  Serial.begin(115200);
  pinMode(uyari, OUTPUT);
  WiFi.begin(ssid, password);
  lcd.init();
  lcd.backlight();
  Serial.println("Bağlanılıyor");
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");
    uyar();
  }
  Serial.println("");
  Serial.print(ssid);
  Serial.print(" İsimli Ağa, ");
  Serial.println(WiFi.localIP());
  Serial.print(" IP Adresi İle Bağlanıldı: ");
  delay(10);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Baglanilan Ag :");
  lcd.setCursor(0, 1);
  lcd.print(ssid);
  delay(500);
  lcd.clear();

  dht.begin();
  timeClient.begin();
}

//Uyarı sistemi icin ayri bir dongu
void uyar()
{
  digitalWrite(uyari, HIGH);
  delay(250);
  digitalWrite(uyari, LOW);
  delay(50);
  digitalWrite(uyari, HIGH);
  delay(250);
  digitalWrite(uyari, LOW);
  delay(50);
  digitalWrite(uyari, HIGH);
  delay(250);
  digitalWrite(uyari, LOW);
  delay(50);
}

//Wifi kontrolu icin ayrı bir dongu
void wifi_check()
{
  timeClient.update();
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");
    digitalWrite(uyari, HIGH);
    delay(50);
    digitalWrite(uyari, LOW);
    delay(25);
    digitalWrite(uyari, HIGH);
    delay(50);
    digitalWrite(uyari, LOW);
    delay(25);
    digitalWrite(uyari, HIGH);
    delay(50);
    digitalWrite(uyari, LOW);
    delay(25);
  }
}

void loop() {
  humidityData = dht.readHumidity();
  temperatureData = dht.readTemperature(); 

  sic= dht.readTemperature();
  nem= dht.readHumidity();
  
  wifi_check();

  //Check WiFi connection status
  if(WiFi.status()== WL_CONNECTED){
    HTTPClient http;
    
    // Sunucu dosya yolunu değişkene atıyoruz
    http.begin(serverName);
    
    // İçerik türü başlığı
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    
    // HTTP POST verilerinin hazırlığı
    String httpRequestData = "api_key=" + apiKeyValue + "&sic=" + String(dht.readTemperature()) + "&nem=" + String(dht.readHumidity()) + "&bas=" + String(bas) + "";
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);
    
    // HTTP POST isteği gönderiliyor
    int httpResponseCode = http.POST(httpRequestData);
        
    if (httpResponseCode>0 || httpResponseCode<404) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
    }

    else if (httpResponseCode == 404) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
      
      uyar();
    }
    
    else
    {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);

      uyar();
    }
    http.end();
  }
  else {
    Serial.println("WiFi Disconnected");
  }

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Saat : ");
  lcd.print(timeClient.getHours());
  lcd.print(":");
  lcd.print(timeClient.getMinutes());
  lcd.print(":");
  lcd.print(timeClient.getSeconds());
  lcd.setCursor(0, 1);
  lcd.print("Sicaklik : " + String(sic));
  
  delay(500);
  
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Saat : ");
  lcd.print(timeClient.getHours());
  lcd.print(":");
  lcd.print(timeClient.getMinutes());
  lcd.print(":");
  lcd.print(timeClient.getSeconds());
  lcd.setCursor(0, 1);
  lcd.print("Nem : " + String(nem));
  delay(500);
}
