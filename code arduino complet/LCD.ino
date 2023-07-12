#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <LiquidCrystal_I2C.h>
#include "I2CScanner.h"
#include <ArduinoJson.h>
const char *ssid = "Globalnet XD";  //ENTER YOUR WIFI ssid
const char *password = "dar benkhaled96448329";  //ENTER YOUR WIFI password
const char *host = "192.168.1.10";
String MYID ="A";
I2CScanner scanner;
// Set the LCD address to 0x27 for a 16 chars and 2 line display
LiquidCrystal_I2C lcd(0x27, 20, 4);
#define Btn D0
#define Led_R D3
//#define Led_O 6
#define Led_G D4
#define Buzzer D5

#define Is_Stopped  0
#define Is_Counting 1
//#define Test;

unsigned long start = millis();
unsigned long compteur = 0;
unsigned long MS;
uint8_t Btn_Status_New = 0;
uint8_t Btn_Status_Old = 0;
uint8_t Counter_Status = 0;
uint8_t position_horloge = 4;

int Clock = 0 ; 
int number = 0;
int Minutes = 0;
int Seconds = 0;
int Milliseconds=0;
unsigned long previousMillis = 0;
#ifdef Test       
   long interval = 100; 
#else  
   long interval = 1000;
#endif

void setup() 
{Serial.begin(9600);
  WiFi.begin(ssid, password);
  Serial.println("UART OK");
  scanner.Init();
  scanner.Scan();
  lcd.begin();
  //lcd.init();
  lcd.clear();
  pinMode(Btn, INPUT_PULLUP);
  pinMode(Buzzer, OUTPUT);
  pinMode(Led_R, OUTPUT);
  pinMode(Led_G, OUTPUT);
 // pinMode(Led_O, OUTPUT);
  lcd.backlight();
  lcd.clear();
  while (WiFi.status() != WL_CONNECTED) {
Serial.println("...");
delay(1000);
}
Serial.print("Great connexion work! ");
Serial.println("IP Address: ");
Serial.println(WiFi.localIP());
delay(500);
// Check HTTP status
HTTPClient http;
http.begin("http://192.168.1.10/swim/index.php?api=getTrinigJeson");
int httpCode = http.GET();
if (httpCode) {
if (httpCode >0) {
String client = http.getString();
Serial.println(client);
const size_t capacity =JSON_ARRAY_SIZE(1) + JSON_OBJECT_SIZE(4)+ 119;
    DynamicJsonDocument doc(capacity);


    //parse Json object



const char* json = "[{\"type_nage\":\"4n\",\"M\":\"100\",\"D\":\"8\",\"date\":\"2020-11-23\"}]";

deserializeJson(doc, json);

JsonObject root_0 = doc[0];
const char* root_0_type_nage = root_0["type_nage"]; // "4n"
const char* root_0_M = root_0["M"]; // "100"
const char* root_0_D = root_0["D"]; // "8"
const char* root_0_date = root_0["date"]; // "2020-11-23"





    
    
          
  lcd.clear();
  lcd.setCursor(1, 4);
  lcd.print("date:");
  lcd.print(root_0_date);
  lcd.setCursor(1, 1);
  lcd.print("repetition:");
  lcd.print(root_0_D);
  lcd.setCursor(1, 2);
  lcd.print("Distance:");
  lcd.print(root_0_M);
  lcd.setCursor(1, 3);
  lcd.print("type de nage:");
  lcd.print(root_0_type_nage);
  
}
  http.end();
}
}

void loop() {



unsigned long currentMillis = millis();

  Btn_Status_New = !digitalRead(Btn);
   delay (300);
  if(Btn_Status_New && !Btn_Status_Old)
  {
    if(Counter_Status == Is_Stopped)
    {
      Counter_Status = Is_Counting;
      //Rajouter Animation de départ

      
       digitalWrite(Led_G,LOW);
      for ( int i = 0 ; i <= 1 ; i++ ) {
     
       digitalWrite(Led_R,HIGH);
       digitalWrite(Buzzer, HIGH);
        delay (300);
        digitalWrite(Led_R,LOW);
        digitalWrite(Buzzer, LOW);
        delay (300);
      
      
      }
      //fin animation de départ
      lcd.clear();
      start = millis();
      previousMillis = currentMillis;
      Serial.print("Fonction Millis() : ");
      Serial.println(MS);
      Serial.print("variable start : ");
      Serial.println(start);
      //Rajouter Animation de départ suite

      
      digitalWrite(Led_R,LOW);
      digitalWrite(Led_G,HIGH);
      digitalWrite(Buzzer, HIGH);
      delay(100);
      digitalWrite(Buzzer, LOW);

      
      //fin animation de départ
       
    }
    else //if(Counter_Status == Is_Counting)
    {
      lcd.clear();
      Counter_Status = Is_Stopped;
      MS = millis();
      Clock = (MS - start) / 1000;
      Minutes = Clock/60;
      Seconds = Clock % 60;
      Milliseconds = (MS - start) % 100;

      Serial.println("Temps final : ");
      Serial.print(Minutes);
      Serial.print(":");
      Serial.print(Seconds);
      Serial.print(":");
      Serial.println(Milliseconds);
      Serial.print("Fonction Millis() : ");
      Serial.println(MS);
      Serial.print("variable start : ");
      Serial.println(start);
      //position_horloge++;
      char timess[16]="";
      sprintf(timess,"%02d:%02d:%02d",Minutes,Seconds,Milliseconds);
      
    lcd.print(timess);
     HTTPClient http;    //Declare object of class HTTPClient
     String Link = "http://192.168.1.10/swim/test.php?";
   //String Link = "http://192.168.1.11/swim/test.php?&duree="+String(timess);

    //Link = Link +"lanes="+MYID;
    Link = Link +"lanes=A&duree="+String(timess);
               //http://localhost/swim/test.php?lanes=A&duree=times

    Serial.println (Link);
      
    http.begin(Link);     //Specify request destination
    int httpCode = http.GET();            //Send the request
    String payload = http.getString();
      
    

    switch (httpCode)
    {
      case 200: Serial.println(" -> SUCCESS");
      case 301: Serial.println(" -> Redirected");
      case 401: Serial.println(" -> Not authentified");
      case 403: Serial.println(" -> Access denied");
      case 404: Serial.println(" -> Not found");
      case 500: Serial.println(" -> Server error");
      case 504: Serial.println(" -> No answer from server");
      default : Serial.println("Answer not in scope");
    }
   
    http.end();  //Close connection
    
  
  delay(5000);  //Post Data at every 5 seconds
    }
  }
  
  if(Counter_Status == Is_Counting && currentMillis - previousMillis >= interval)
  {
    
      previousMillis = currentMillis;
      MS = millis();
      Clock = (MS - start) / 1000;
      Minutes = Clock/60;
      Seconds = Clock % 60;
      Milliseconds = (MS - start) % 100;
      char times[16]="";
      sprintf(times,"%02d:%02d:%02d",Minutes,Seconds,Milliseconds);
      
      lcd.setCursor(3, 0);
      lcd.print(times);
      /*lcd.print(Clock);
      lcd.setCursor(4, 0);
      lcd.print("s");*/
      
      Serial.println("Compteur : ");
      Serial.print(Minutes);
      Serial.print(":");
      Serial.print(Seconds);
      Serial.print(":");
      Serial.println(Milliseconds);
     
  }
  Btn_Status_Old = Btn_Status_New;

 
}
//function to connect to wifi



//function to send sensor data 
